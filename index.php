<?php
require_once('./db.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./dist/img/favicon.ico">

    <title>Cricket Quiz</title>

    <!-- Bootstrap core CSS -->
    <link href="./dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Page styles -->
    <link href="./dist/css/app.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <img class="pr-2" height="48px" src="./dist/img/cricket.png"/>
      <a class="navbar-brand" href="#">Cricket Quiz</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      </div>
    </nav>

    <main role="main" class="container">
      <div class="row intro">
        <div class="col-12">
          <h1 class="text-center">Cricket Quiz</h1>
          <h3 class="text-center js-quizScore">Are you a cricket master? Take the quiz and find out!</h3>
          <div class="js-quizGif d-none justify-content-center">
            <img class="rounded" src="./dist/img/gifs/cricketFail.gif"/>
          </div>
        </div>
      </div>

      <?php
      $db = new DB();
      if($_GET['quizStarted']) {
        $questions = $db->getQuestionData();
      } else {
        ?>
        <div class="row col-md-auto intro">
          <div class="d-flex justify-content-center col-12">
            <button class="mt-3 btn btn-primary js-startQuizBtn">Start the Quiz!</button>
          </div>
        </div>
        <?php
      }
      ?>

      <form class="quizForm">
      <?php
      $i = 0;
      foreach($questions['id'] as $question) {
        ?>
        <div class="row my-5 mx-1 question">
          <div class="col-12">
          <h3><?php echo $questions['id'][$i]; ?>. <?php echo $questions['questionText'][$i]; ?></h3>
            <div class="card">
              <div class="card-body">
                <div class="form-check my-1">
                  <label class="form-check-label">
                    <input type="radio" value="A" class="form-check-input js-question-<?php echo $questions['id'][$i]; ?>-a" name="question-<?php echo $questions['id'][$i]; ?>[]"> <?php echo $questions['optionA'][$i]; ?>
                  </label>
                </div>
                <div class="form-check my-1">
                  <label class="form-check-label">
                    <input type="radio" value="B"  class="form-check-input js-question-<?php echo $questions['id'][$i]; ?>-b" name="question-<?php echo $questions['id'][$i]; ?>[]"> <?php echo $questions['optionB'][$i]; ?>
                  </label>
                </div>
                <div class="form-check my-1">
                  <label class="form-check-label">
                    <input type="radio" value="C"  class="form-check-input js-question-<?php echo $questions['id'][$i]; ?>-c" name="question-<?php echo $questions['id'][$i]; ?>[]"> <?php echo $questions['optionC'][$i]; ?>
                  </label>
                </div>
                <div class="form-check my-1">
                  <label class="form-check-label">
                    <input type="radio" value="D"  class="form-check-input js-question-<?php echo $questions['id'][$i]; ?>-d" name="question-<?php echo $questions['id'][$i]; ?>[]"> <?php echo $questions['optionD'][$i]; ?>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
        <?php
        $i++;
      }
      if($_GET['quizStarted']) {
        ?>
        <div class="row mx-1 pb-5 my-5">
          <div class="col-12">
            <button class="btn btn-success js-submitQuizBtn" type="button">Submit Quiz</button>
          </div>
        </div>
        <?php
      }
      ?>
      </form>
    </main><!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="./dist/jquery/jquery-slim.min.js"><\/script>')</script>
    <script src="./dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="./dist/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
    $('.js-startQuizBtn').on('click', function() {
      window.location.href = '/cricketQuiz?quizStarted=true'
    })

    $('.js-submitQuizBtn').on('click', function() {
      $.ajax({
        url: 'endpoints/submit-quiz.php',
        type: 'post',
        data: $('.quizForm').serialize(),
        success: function(response) {
            $('.js-quizGif').addClass('d-none')
            $('.js-quizGif').removeClass('d-flex')
            $('.form-check').each(function(index) {
              $(this).removeClass('alert alert-danger pl-4')
              $(this).removeClass('alert alert-success pl-4')
            })

            const questionData = JSON.parse(response)
            const quizScore = questionData['quizScore']
            let quizMessage
            let quizGif

            if(quizScore >= 90) {
              quizMessage = 'Wow, you really know your stuff!'
              quizGif = 'cricketWin.gif'
            } else if(quizScore >= 70 && quizScore < 90) {
              quizMessage = "Nice! You're pretty good at this."
              quizGif = 'cricketSwing.gif'
            } else if(quizScore <= 60){
              quizMessage = 'Yikes! Try again?'
              quizGif = 'cricketFail.gif'
            }

            for (let key in questionData['missedQuestions']) {
              $(`.js-question-${key}-${questionData['missedQuestions'][key].toLowerCase()}`).closest('.form-check').addClass('alert alert-danger pl-4')
            }
            for (let key in questionData['correctQuestions']) {
              $(`.js-question-${key}-${questionData['correctQuestions'][key].toLowerCase()}`).closest('.form-check').addClass('alert alert-success pl-4')
            }
            $('.js-quizScore').html('You scored ' + quizScore + '! ' + quizMessage)
            $('.js-quizGif').find('img').attr('src', './dist/img/gifs/' + quizGif)
            $('.js-quizGif').addClass('d-flex')
            $('.js-quizGif').removeClass('d-none')
            $("html, body").animate({ scrollTop: 0 }, 'fast')

        },
        error: function() {
            alert('There was an error processing your request.')
        }
      })
    })
    </script>
  </body>
</html>
