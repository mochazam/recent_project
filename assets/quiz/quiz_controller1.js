function Quiz(questions) {
	this.score = 0;
	this.questions = questions;
	this.questionIndex = 0;
	this.gSkor = new Array();

}

Quiz.prototype.getQuestionIndex = function () {
	return this.questions[this.questionIndex];
}

Quiz.prototype.isEnded = function () {
	return this.questions.length === this.questionIndex;
}

Quiz.prototype.guess = function (answer) {

	if (this.getQuestionIndex()) {
		this.score++;
	}

	this.questionIndex++;

}

Quiz.prototype.getAll = function (answer, gSkor) {
	this.gSkor.push(answer);
}