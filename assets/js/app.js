/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';
import 'materialize-css'


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

M.AutoInit();

const poll = document.querySelector('.poll');
const questions = [...poll.querySelectorAll('.question')];
const lastQuestion = questions.slice(-1)[0];
const firstQuestion = questions[0];

const buttons = {
    next: document.querySelector('.js-question-next'),
    prev: document.querySelector('.js-question-prev'),
    submit: document.querySelector('.js-poll-submit'),
}

function validateAnswer(question) {
    const {required, fieldType} = question.dataset;

    if (!required) {
        return true;
    }

    if (fieldType === 'choice') {
        return question.querySelectorAll('input:checked').length !== 0;
    }

    const field = question.querySelector('input');

    return field.value.length !== 0;
}

buttons.next.addEventListener('click', () => {
    const activeQuestionIndex = questions.findIndex(question => question.classList.contains('active'));
    const activeQuestion = questions[activeQuestionIndex];

    if (!validateAnswer(activeQuestion)) {
        M.toast({'html': 'Invalid answer'})
        return;
    }

    const nextQuestion = questions[activeQuestionIndex + 1];

    activeQuestion.classList.remove('active');
    nextQuestion.classList.add('active');

    if (nextQuestion === lastQuestion) {
        buttons.next.classList.add('hide');
        buttons.submit.classList.remove('hide');
    }

    buttons.prev.classList.remove('hide');
});

buttons.prev.addEventListener('click', () => {
    const activeQuestionIndex = questions.findIndex(question => question.classList.contains('active'));
    const activeQuestion = questions[activeQuestionIndex];
    const prevQuestion = questions[activeQuestionIndex - 1];

    activeQuestion.classList.remove('active');
    prevQuestion.classList.add('active');

    if (prevQuestion === firstQuestion) {
        buttons.prev.classList.add('hide');
    }

    buttons.next.classList.remove('hide')
    buttons.submit.classList.add('hide');
})


buttons.submit.addEventListener('click', e => {
    if (!validateAnswer(lastQuestion)) {
        e.preventDefault();
        M.toast({'html': 'Invalid answer'})
    }
});
