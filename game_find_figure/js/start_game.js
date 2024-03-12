import { count_items, count_tasks, time_wait, quest_color, colors, shapes, shapesBoard, blobs } from "./consts.js";

let currentTask = 0;
let countAnsw = 0;

let userScore = 0;
let level = localStorage.getItem("last_level");
let task_tracking = document.querySelector('.task_tracking').children;

// добавление паузы
document.querySelector('.header_button').insertAdjacentHTML('beforebegin',
    `<button class="header_button pause" onclick="pause()" type="button"><img src="styles/icons/pause.svg" alt="svg"></button>`
)

// добавление индикаторов
document.querySelector('.task_tracking').innerHTML = '<div class="task_indicator"></div>'.repeat(count_tasks);

if (level == 2){
    generate_cvetango();
    document.querySelector('.title_quest').style = 'padding: 40px 0 20px 0; display: flex; justify-content: center; align-items: center;';
    document.querySelectorAll('.figure').forEach( elem => { elem.style = 'width: clamp(15px, 15%, 200px)' });
    
    showRules(2);
}
else {
    generate_task();
    showRules(level);

    // 3 уровень
    if (level ==  3){
        setInterval(()=>{
            document.querySelector('header').insertAdjacentHTML('beforebegin', 
            `<div class="wrap_blob" style="left: calc(${random(90)}% + 10px); top: calc(${random(70)}% + 20px)"> ${blobs[random(blobs.length)]} </div>`);
            setTimeout(()=>{
                document.querySelector('body').firstChild.remove();
            }, 4000);
            document.querySelectorAll('.wrap_blob').forEach(item => {dragNDrop(item)})
        }, 3000);
        
    }
}

function showRules(level){
    document.querySelector('.timer_slider').style.animationPlayState = 'paused';
    if (level == 2){
        document.querySelector('body').insertAdjacentHTML('beforeend',
        `<div class="wrap_res">
            <h1 class="title">Правило</h1>
            <h style="font-size: 14pt">Выбрать все фигуры, не пересекающиеся ни цветом, ни формой с данными фигурами</h style="font-size: 14pt">
            <form><button class="button" type="button">поехали</button></form>
        </div>
        <div class="mask"></div>`);
    }
    else{
        document.querySelector('body').insertAdjacentHTML('beforeend',
        `<div class="wrap_res">
            <h1 class="title">Правило</h1>
            <h style="font-size: 14pt">Выбрать все фигуры с заданным свойством (формой или цветом)</h style="font-size: 14pt">
            <form><button class="button" type="button">поехали</button></form>
        </div>
        <div class="mask"></div>`);
    }
    document.querySelector('.button').addEventListener('click', ()=>{
        document.querySelector('.timer_slider').style.animationPlayState = 'running';
        document.querySelector('.mask').remove();
        document.querySelector('.wrap_res').remove();
    });
}

//генерация задания
function generate_task(){
    let items = document.querySelector('.items');
    let title = document.querySelector('.title_quest');
    countAnsw = 0;
    let task_figures = [];

    //выбор случайных фигур
    for (let i = 0; i < count_items[level-1]; i++){
        task_figures.push({shape: shapes[random(shapes.length)] , color: colors[random(colors.length)] });
    }

    // выбор цвета или формы для задания
    let property;
    let is_shape_property = random(2); //0 - color, 1 - shape
    if (is_shape_property){
        property = shapes[random(shapes.length)]
        title.innerHTML = `Выберите все <span style="font-weight: bold; margin: 0 5px">${shapesBoard[property].quest}</span>`;
        task_figures[random(task_figures.length)].shape = property; //для гарантии правильных ответов
    } else{
        property = colors[random(colors.length)]
        title.innerHTML = `Выберите все <span style="color: ${property}; margin: 0 5px">${quest_color[property]}</span> фигуры`;
        task_figures[random(task_figures.length)].color = property;
    }

    items.replaceChildren(); // очищение от фигур

    // вставка фигур
    items.insertAdjacentHTML('beforeend', 
        `${setFigures(task_figures)}`
    );

    isStartTimer(true); // запуск таймера

    let arrAnswers = Array.from(document.querySelectorAll(`.${property}`));
    //обработка нажатия на ответы
    document.querySelectorAll('.figure').forEach( item =>{
        item.addEventListener('click', ()=>{ processing(item, arrAnswers, generate_task) })
    });

    if (level==3){
        let timeAni = Math.random()+1;
        document.querySelectorAll('.svg_fig').forEach( elem => {
            if (random(2)){ elem.style = `animation: spinning ${timeAni}s linear infinite` }
            else { elem.style = `animation: wobble ${timeAni}s linear infinite` }
        });
        document.querySelectorAll('.figure').forEach( elem => { elem.style = 'width: clamp(15px, 6%, 150px)'});
    }
}

function generate_cvetango(){
    let items = document.querySelector('.items');
    let title = document.querySelector('.title_quest');
    countAnsw = 0;
    let task_figures = [];

    // выбор цветов и форм для задания
    let properties = [];
    properties.push(shapes[random(shapes.length)]);
    properties.push(shapes[random(shapes.length)]);
    properties.push(colors[random(colors.length)]);
    properties.push(colors[random(colors.length)]);

    // заполнение массива фигур
    task_figures.push({shape: properties[0], color: properties[3]});
    task_figures.push({shape: properties[1], color: properties[2]});
    task_figures.push({shape: properties[0], color: properties[2]});
    task_figures.push({shape: properties[1], color: properties[3]});
    let availableShapes = shapes.filter(x => !properties.includes(x));
    let availableColors = colors.filter(x => !properties.includes(x));
    task_figures.push({shape: availableShapes[random(availableShapes.length)], color: availableColors[random(availableColors.length)]});
    for (let i = 0; i < count_items[level-1]-5; i++){
        task_figures.push({shape: shapes[random(shapes.length)], color: colors[random(colors.length)]});
    }

    title.innerHTML = `Дано:
        <div class="minifigure ${properties[0]} ${properties[2]}">${wrapFigure(task_figures[2].shape)}</div>
        <div class="minifigure ${properties[1]} ${properties[3]}">${wrapFigure(task_figures[3].shape)}</div>`;
    
    items.replaceChildren(); // очищение от фигур
    
    task_figures = shuffle(task_figures); // перемешивание массива

    // вставка фигур
    items.insertAdjacentHTML('beforeend', 
        `${setFigures(task_figures)}`
    );

    isStartTimer(true); // запуск таймера

    // нахождение правильных ответов
    let arrWrongFigures = Array.from(document.querySelectorAll(`.${properties[0]}`));
    arrWrongFigures = arrWrongFigures.concat(Array.from(document.querySelectorAll(`.${properties[1]}`)));
    arrWrongFigures = arrWrongFigures.concat(Array.from(document.querySelectorAll(`.${properties[2]}`)));
    arrWrongFigures = arrWrongFigures.concat(Array.from(document.querySelectorAll(`.${properties[3]}`)));
    console.log(Array.from(new Set(arrWrongFigures))); // убираем дубликаты
    let arrAnswers = Array.from(document.querySelectorAll('.figure')).filter(x => !arrWrongFigures.includes(x));

    //обработка нажатия на ответы
    document.querySelectorAll('.figure').forEach( item =>{
        item.addEventListener('click', ()=>{ processing(item, arrAnswers,generate_cvetango) })
    });
}

function isStartTimer(a){
    if (a){ // добавление таймера
        document.querySelector('.timer').insertAdjacentHTML('afterbegin', `<div class="timer_slider"></div>`);
        let timer_slider = document.querySelector('.timer_slider');
        timer_slider.style = `animation: ${time_wait}s timer forwards linear`;
        timer_slider.addEventListener('animationend', ()=>{
            task_tracking[currentTask++].style = 'background: brown';
            if (currentTask == count_tasks){
                showRes();
            }
            else{
                isStartTimer(false);
                generate_task();
            }
        });
    }
    else{ // удаление таймера
        document.querySelector('.timer').replaceChildren();
    }
}

function showRes(){
    document.querySelector('.pause').remove();
    document.querySelector('.timer_slider').remove();
    document.querySelector('body').insertAdjacentHTML('beforeend',
    `<div class="wrap_res">
        <h class="title">Ваш результат: ${userScore}</h>
        <form><button class="button" type="submit">ещё раз</button></form>
    </div>
    <div class="mask"></div>`);
    
    // сохранение результата
    let name = localStorage.getItem("last_player");
    let userScores = localStorage.getItem(name).split(',');
    userScores[level-1] = userScore > (userScores[level-1]||0)? userScore: userScores[level-1];
    if (isNaN(userScores[level-1])){
        userScores[level-1] = userScore;
    }
    userScores[level-1] = +userScores[level-1];
    localStorage.setItem(name, userScores);
    let res = document.querySelector('.wrap_res');
}

function processing(item, arrAnswers, generate){
    if (arrAnswers.includes(item)){
        countAnsw += 1; // количество выбранных правильных ответов
        // item.removeEventListener('click', ()=>{ processing(item, arrAnswers) });
        item.style = 'background: rgb(90 169 90)';
        
        if (countAnsw == arrAnswers.length){
            userScore += 1;
            task_tracking[currentTask++].style = 'background: green';
            if (currentTask == count_tasks){
                showRes();
            }
            else{
                isStartTimer(false);
                generate();
            }
        }
    }
    else{
        task_tracking[currentTask++].style = 'background: brown';
        if (currentTask == count_tasks){
            showRes();
        }
        else{
            isStartTimer(false);
            generate();
        }
    }
}

function setFigures(figures){
    return figures.map(
        (item) => `<div class="figure ${item.shape} ${item.color}"> ${wrapFigure(item.shape)} </div>`
    ).join('');
}

function wrapFigure(shape){
    return `<svg class="svg_fig" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ${shapesBoard[shape].w} 300" >
        <path d="${shapesBoard[shape].svg}"></path></svg>`;
}

function random(n){
    return Math.floor(Math.random()*n);
}

function shuffle(items){
    let randOrderArr = items;
    let rnd;
    let len = items.length-1;
    for (let i = 0; i < len; i++){
        rnd = Math.floor(Math.random() * (len - i + 1) + i);
        let tempItem = randOrderArr[i];
        randOrderArr[i] = randOrderArr[rnd];
        randOrderArr[rnd] = tempItem;
    }
    return randOrderArr;
}

function dragNDrop(item){
    item.onmousedown = function (event) {
        item.style.position = 'absolute';
            
        // перемещение слова при зажатии мыши
        moveAt(event.pageX, event.pageY);
        function moveAt(pageX, pageY) {
            item.style.left = pageX - item.offsetWidth / 2 + 'px';
            item.style.top = pageY - item.offsetHeight / 2 + 'px';
        }
        
        document.addEventListener('mousemove', onMouseMove);
        // обработка нажатия
        item.onmouseup = function() {
            document.removeEventListener('mousemove', onMouseMove);
            item.onmouseup = null;
        };

        function onMouseMove(event) {
            moveAt(event.pageX, event.pageY);
        }
    }
}