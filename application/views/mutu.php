
<!DOCTYPE html>
<html>
<head>
	<title>jQuery - quiz</title>
	<!--	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>		-->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap2.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/quiz/style.css">
</head>
<body>

	<div class="grid">
		<div id="quiz">
			<h1>Kuesioner</h1>
			<hr style="margin-bottom: 20px">

			<p id="question"></p>

			<div class="buttons">
				<button id="btn0"><span id="choice0"></span></button>
				<button id="btn1"><span id="choice1"></span></button>
				<button id="btn2"><span id="choice2"></span></button>
				<button id="btn3"><span id="choice3"></span></button>
			</div>

			<hr style="margin-top: 50px">
			<footer>
				<p id="progress"></p>
			</footer>
		</div>
	</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/quiz/quiz_controller1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/quiz/question1.js"></script>

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
			var tomb = document.getElementsByTagName("button")[i];
			var element = document.getElementById("choice" + i);
			element.innerHTML = choices[i];
			tomb.setAttribute("value", choices[i]);
			guess("btn" + i, choices[i]);	

				
		}

		showProgress();
	}
};


function guess(id, guess) {
	var button = document.getElementById(id);
	var valSkor = document.getElementById(id).value;
	var gskor = [];
	button.onclick = function() {
		
		quiz.guess(guess);
		populate();

		quiz.getAll(guess, gskor);
    	
    	//alert(valSkor);
	}
};

function showProgress() {
	var currentQuestionNumber = quiz.questionIndex + 1;
	var element = document.getElementById("progress");
	element.innerHTML = "Question " + currentQuestionNumber + " of " + quiz.questions.length;
}

function showScores() {
	var gameOverHtml = "<h1>Result</h1>";
	gameOverHtml += "<h2 id='score'> Your scores: " + quiz.gSkor + "</h2>";
	var element = document.getElementById("quiz");
	element.innerHTML = gameOverHtml;
};

//get data from DB
var soal = JSON.parse('<?php $this->m_mutu->getSoal(); ?>');
var pilihan = JSON.parse( '<?php $this->m_mutu->getSkor(); ?>');

var questions = [];
for (var i = 0; i < soal.length; i++) {
	questions.push(new Question(soal[i].soal));
};

var quiz = new Quiz(questions);

populate();

</script>


</body>
</html>
