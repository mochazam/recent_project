
<!DOCTYPE html>
<html>
<head>
	<title>jQuery - quiz</title>
	<!--	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>		-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/quiz.css">
	<style type="text/css">
	
	</style>
</head>
<body>

	<div class="modal1" >
  		<div class="modal-dialog">
    		<div class="modal-content" id="quiz">
      			<div class="modal-header grid">
      				<h1>Quiz</h1>
      			</div>
      			<div class="modal-body">
        			<p id="question"></p>
        			<div class="row">
        				<div class="col-md-6">
        					<button class="btn btn-primary" id="btn0"><span id="choice0"></span></button>
							<button class="btn btn-primary" id="btn2"><span id="choice2"></span></button>
        				</div>
        				<div class="col-md-6">
							<button class="btn btn-primary" id="btn1"><span id="choice1"></span></button>
							<button class="btn btn-primary" id="btn3"><span id="choice3"></span></button>
        				</div>
        			</div>
      			</div>
      			<div class="modal-footer">
      				<p id="progress"></p>
        			
      			</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/quiz/quiz_controller.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/quiz/question.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/quiz/app.js"></script>

<script type="text/javascript">
function populate() {
	if (quiz.isEnded()) {
		showScores();
	} else {
		//show question
		var element = document.getElementById("question");
		var currentQuestionNumber = quiz.questionIndex + 1;
		element.innerHTML = currentQuestionNumber + ". " + quiz.getQuestionIndex().text;

		//show choices
		var choices = [];
		for (var i = 0; i < pilihan.length; i++) {
			choices.push(pilihan[i].nilai);
		}

		for (var i = 0; i < choices.length; i++) {
			var element = document.getElementById("choice" + i);
			element.innerHTML = choices[i];	
			guess("btn" + i, choices[i]);		
		}

		showProgress();
	}
};

function guess(id, guess) {
	var button = document.getElementById(id);
	button.onclick = function() {
		quiz.guess(guess);
		populate();
	}
};

function showProgress() {
	var currentQuestionNumber = quiz.questionIndex + 1;
	var element = document.getElementById("progress");
	element.innerHTML = "Question " + currentQuestionNumber + " of " + quiz.questions.length;
}

function showScores() {
	var gameOverHtml = "<h1>Result</h1>";
	gameOverHtml += "<h2 id='score'> Your scores: " + quiz.score + "</h2>";
	var element = document.getElementById("quiz");
	element.innerHTML = gameOverHtml;
};

//get data from DB
var soal = JSON.parse('<?php $this->m_quiz->fetchSoal(); ?>');
var pilihan = JSON.parse( '<?php $this->m_quiz->fetchSkor(); ?>');

var questions = [];
for (var i = 0; i < soal.length; i++) {
	questions.push(new Question(soal[i].soal));
};

var quiz = new Quiz(questions);

populate();

</script>


</body>
</html>
