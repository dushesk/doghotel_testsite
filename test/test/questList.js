import { questions } from "./questions.js";
import { shuffleArray, runQuestion } from "./main.js";
import { Question } from "./classQuestion.js";

// обработчики нажатий на кнопки в меню
export function menuButtonListener(){
    document.querySelector('.questList').addEventListener('click', function() { showQuestionList(questions); });
    document.querySelector('.addQuest').addEventListener('click', addQuestion);
    document.querySelector('.startButton').addEventListener('click', function() {
        let randOrderQuestions = shuffleArray(questions); // случайный порядок вопросов
        runQuestion(randOrderQuestions, 0); 
    });
}

// форма ввода вопроса
function addQuestion(){
    const d = document.querySelector(".conteiner");
    d.remove();
    document.querySelector("body").insertAdjacentHTML(
        'afterbegin',
        `<div class="conteiner">
            <form>
                <label> 
                    <h1> Добавьте вопрос </h1>
                    <textarea id ="quest" cols="60" rows="5" placeholder="Ваш вопрос"></textarea>
                    <input type="text" id ="correctAnsw" placeholder="Правильный ответ">
                    <input type="text" id ="wrongAnsw1" placeholder="Неправильный ответ">
                    <input type="text" id ="wrongAnsw2" placeholder="Неправильный ответ">
                </label>
                <button type="button" class="saveButton">Сохранить</button>
            </form>
        </div>`
    );
    handleInput();
}

// занесение вопроса в массив
function handleInput(){
    const form = document.querySelector('.saveButton');
    form.addEventListener('click', ()=>{
        document.documentElement.style.cssText = "--main-color: #a1da8b";
        const quest = document.getElementById("quest").value;
        const corrAnsw = document.getElementById("correctAnsw").value;
        const wrAnsw1 = document.getElementById("wrongAnsw1").value;
        const wrAnsw2 = document.getElementById("wrongAnsw2").value;
        questions[questions.length] = new Question(quest, [corrAnsw, wrAnsw1, wrAnsw2], '');
        console.log(questions[questions.length]);
        setTimeout(function() {
            document.documentElement.style.cssText = "--main-color: #e2dbbb";
          }, 500);
    });
}

// вывод всех вопросов
function showQuestionList(quests){
    const d = document.querySelector(".conteiner");
    d.remove();
    document.querySelector("body").insertAdjacentHTML(
        'afterbegin',
        `<div class="conteiner">
            <h1>Вопросы</h1>
            ${setQuestionTitle(quests)}
        </div>`
    );
}

// вывод каждого вопроса
function setQuestionTitle(quest){
    return quest.map(
        (quest, index) => `<p class="questionTitle"> ${index+1}. ${quest.quest} </p>`
    ).join('');
}