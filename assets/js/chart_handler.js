$(document).ready(function(){
      var base_url = 'http://localhost/login_system_2/'
      var question_id = $('#result-card').attr('data-id');
      var survey_type = $('#result-card').attr('data-type');
      var answers;
      var answerLabel = [];
      var question;
      var results;
      var dataSet = [];

      $.ajax({
            async: false,
            type: 'post',
            url: base_url+'surveys/get_answers_by_qid',
            data:{question_id:question_id},
            dataType: 'json',
            success: function(data){
                  answers = data;
                  
            },
            error: function(){
                  console.log('Error in answers ajax call');
            }
      });

       $.ajax({
            async: false,
            type: 'post',
            url: base_url+'surveys/get_sums_by_answers',
            data:{answers:JSON.stringify(answers), type:survey_type},
            dataType: 'json',
            success: function(data){
                  results = data;
            },
            error: function(){
                  console.log('Error in results ajax call');
            }
      });
      $.ajax({
            async: false,
            type: 'post',
            url: base_url+'surveys/get_question_by_qid',
            data:{question_id:question_id},
            dataType: 'json',
            success: function(data){
                  question = data;
            },
            error: function(){
                  console.log('Error in question ajax call');
            }
      });
      
      for(var idx = 0; idx < answers.length; idx++){
            answerLabel[idx] = answers[idx]['answer'];
      }
      console.log(results);
      if(survey_type == 1){
            for(var idx = 0; idx < results.length; idx++){
                  if(results[idx]['sum'] != null){
                        dataSet[idx] = results[idx]['sum'];
                  } else {
                        dataSet[idx] = 0;
                  }
            }
            $('#answers').hide();
            colorArray = []
            function getRandomColor() {
                  var letters = '0123456789ABCDEF';
                  var color = '#';
                  for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                  }
                  return color;
                }
            for(var idx = 0; idx < dataSet.length; idx++){
                  colorArray[idx] = getRandomColor();
            }
            var ctx = document.getElementById('result-chart').getContext('2d');
            var chart = new Chart(ctx, {
                  // The type of chart we want to create
                  type: 'pie',

                  // The data for our dataset
                  data: {
                        labels: answerLabel,
                        datasets: [{
                              backgroundColor:colorArray,
                              borderColor: 'rgb(255, 255, 255)',
                              data: dataSet,
                        }]
                        
                  },

            // Configuration options go here
                  options: {}
            });
      } else {
            
            if(results['avg'] != null){
                  var val = parseFloat(results['avg']).toPrecision(3);
                  for(var idx = 1; idx <= Math.floor(val); idx++){
                        $('#rating-area').append('<img src="'+base_url+'assets/icons/star.png" />');
                  }
                  if(val%1 > 0){
                        $('#rating-area').append('<img src="'+base_url+'assets/icons/star-half-empty.png" />');
                  }
                  for(var idx = 0; idx < 5-Math.ceil(val);idx++){
                        $('#rating-area').append('<img src="'+base_url+'assets/icons/star-empty.png" />');
                  }
                  $('#rating-area').append('('+val+' / 5)');

                  
            } else {
                  for(var idx = 0; idx < 5;idx++){
                        $('#rating-area').append('<img src="'+base_url+'assets/icons/star-empty.png" />');
                  }
                  $('#rating-area').append('(0 / 5)');
            }
            
            $('#result-chart').hide();
      }
      
});