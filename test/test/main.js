import { menuButtonListener} from "./questList.js";
import { questions } from "./questions.js";

const red = '#d32727';
const green = '#2fb62f';
const speed = 2; // скорость смены ответов (в секундах)
var testResults; // итоги 

start();

// начальное меню
function start(){
    testResults = new Array(); // новый массив с результатами
    const d = document.querySelector(".conteiner");
    d.remove();
    document.querySelector("body").insertAdjacentHTML(
        'afterbegin',
        `<div class="conteiner">
            <button class="button startButton">Начать тест</button>
            <button class="button questList">Список вопросов</button>
            <button class="button addQuest">Добавить вопрос</button>
        </div>`
    );
    menuButtonListener();
}

// вывод после окончания теста
function end(quests){ 
    const doc = document.querySelector(".conteiner");
    doc.remove();
    document.querySelector("body").insertAdjacentHTML(
        'afterbegin',
        `<div class="conteiner"><h1>Вопросы закончились</h1></div>`
    );
    // результаты
    setTimeout(()=>{ setResults(quests) }, speed*1000);
}

// вывод результатов
function setResults(quests){
    const conteiner = document.querySelector(".conteiner");
    conteiner.remove();
    document.querySelector("body").insertAdjacentHTML(
        'afterbegin',
        `<div class="conteiner">
            <div class="header_quest">
                <h1 style="display:inline;">Результаты теста </h1>
                <h>${testResults.reduce((partialSum, a) => partialSum + a, 0)}/${testResults.length}</h>
            </div>
            ${setQuestionRes(quests)}
        </div>`
    );
    // по клику выводится правильный ответ
    let lastClickebButton = document.querySelector('.correctAnsw');
    document.querySelectorAll('.questionTitle').forEach(element => {
        let elementChild = element.childNodes[1];
        elementChild.style.display = 'none';
        element.addEventListener('click', () => {
            
            elementChild.style.display = elementChild.style.display == 'none'? 'block' : 'none';
            lastClickebButton.style.display = 'none';
            lastClickebButton = elementChild;
        });
    });
}

function setQuestionRes(quest){
    return quest.map(
        (quest, index) => 
        `<button class="questionTitle" style="background: ${testResults[index]? green: red};"> 
            ${index+1}. ${quest.quest} 
            <p class="correctAnsw">Правильный ответ: ${quest.answers.find(element=> element[1] == 'correctAnswer')[0]}</p>
        </button>`
    ).join('');
}

// загрузка вопроса из списка
export function runQuestion(quests, numQuestion){
    setQuestion(quests[numQuestion]);
    answerEventListener(quests, numQuestion);
}

// возврат в меню
document.querySelector('.back').addEventListener('click', start);

// при нажатии на ответ
function answerEventListener(quests, numQuestion) { 
    document.querySelectorAll('.answer').forEach(element => {
        // событие при нажатии на ответ
        element.addEventListener('click', function() {
            changeColorOnClickAnswer();
            document.querySelectorAll('.answer').forEach(element => {element.classList.remove('button')});
            // обработка результата
            animateWrongAnswers(document.querySelectorAll('.wrongAnswer')); // исчезновение неправильных ответов
            // обработка нажатия на неправильный ответ
            if (element.classList.contains('wrongAnswer')){ 
                testResults.push(false);
                // увеличение правильного ответа
                document.querySelector('.correctAnswer').style.position = 'absolute';
                document.querySelector('.correctAnswer').style.animation = `increase ${speed}s linear`;

                document.querySelector('h1').insertAdjacentHTML(
                    'afterend', `<h style="color: ${red};">✖</h>`
                );
            }
            // обработка нажатия на правильный ответ
            else if (element.classList.contains('correctAnswer')){ 
                testResults.push(true);
                setCommentToCorrectAnsw(quests[numQuestion]); // добавление комментария
                document.querySelector('h1').insertAdjacentHTML(
                    'afterend', `<h style="color: ${green};">✔</h>`
                );
            }
            if (numQuestion < quests.length-1){
                setTimeout(() => { runQuestion(quests, numQuestion+1);}, speed*1000);
            }
            else{
                setTimeout(() => {end(quests);}, speed*1000);
            }
        });
    });
}

// анимация неправильных ответов
function animateWrongAnswers(elements){
    elements.forEach(element => {
        element.style.animation = `disappearance ${speed}s linear`;
    });
}

// добавляет комментарий к правильному ответу
function setCommentToCorrectAnsw(question){
    document.querySelector('.correctAnswer').insertAdjacentHTML(
        'beforeend',
        `<p>${question.commentCorrectAnswer}</p>`
    )
}

// меняет цвет ответа после нажатия
function changeColorOnClickAnswer(){
    document.querySelectorAll('.wrongAnswer').forEach(item => {
        item.style.background = red;
    });
    document.querySelectorAll('.correctAnswer').forEach(item => {
        item.style.background = green;
    });
}

// размещает вопрос
function setQuestion(question){
    document.querySelector(".conteiner").remove();
    document.querySelector("body").insertAdjacentHTML(
        'afterbegin',
        `<div class="conteiner">
            <div class="header_quest">
                <h1>Вопрос</h1> 
            </div>
            <div class="questWrap">
                <p class="questionTitle"> ${question.quest} </p>
                <div class="wrap-answers"> ${setAnswers(shuffleArray(question.answers))} </div>
            </div>
        </div>`
    );
}

// оборачивает каждый вопрос в тег button
function setAnswers(answers) {
    return answers.map(
        (answer) => `<button type="button" class="button answer ${answer[1]}"> ${answer[0]} </button>`
    ).join('');
}

// возвращает массив с элементами в случайном порядке
export function shuffleArray(items){
    let randOrderArr = items;
    let rnd;
    let len = items.length-1;
    for (let i = 0; i < len; i++){
        rnd = randomIntFromInterval(i, len);
        let tempItem = randOrderArr[i];
        randOrderArr[i] = randOrderArr[rnd];
        randOrderArr[rnd] = tempItem;
    }
    return randOrderArr;
}

// min и max включены
function randomIntFromInterval(min, max) { 
    return Math.floor(Math.random() * (max - min + 1) + min)
}







