
document.querySelector(".button").addEventListener('click', divideWords);

function divideWords(){
    // очищаем поля выводов
    document.querySelector(".field").replaceChildren();
    document.querySelector(".output").replaceChildren();

    showWords(getWords());
    dragDrop();
}

// .mousedown == .touchstart
// .mousemove == .touchmove
// .mouseup  == .touchend

function dragDrop(){
    let wordElems = document.querySelectorAll(".word")

    // обработчик перетаскивания для каждого слова
    wordElems.forEach( word =>
        word.onmousedown = function (event) {
            console.log(11);
            word.style.position = 'absolute';
            word.style.zIndex = 10;
            
            word.hidden = true;
            let currentDroppable = document.elementFromPoint(event.clientX, event.clientY);
            word.hidden = false;

            // перемещение слова при зажатии мыши
            moveAt(event.pageX, event.pageY);
            function moveAt(pageX, pageY) {
                word.style.left = pageX - word.offsetWidth / 2 + 'px';
                word.style.top = pageY - word.offsetHeight / 2 + 'px';
            }
            
            let elemBelow;
            document.addEventListener('mousemove', onMouseMove);
            // обработка нажатия
            word.onmouseup = function() {
                let droppableField = document.querySelector('.droppable');
                let menuWord = document.querySelector('.words_menu');

                function enterDroppable(elem, color) {
                    elem.appendChild(word);
                    word.style.color = color;
                }

                if (elemBelow != currentDroppable){
                    if (elemBelow == droppableField) {
                        enterDroppable(droppableField, 'black');
                        currentDroppable = droppableField;
                        editRes(word, true); // отобразить слово в выводе
                        checkOutOfBounds(word, droppableField);
                    }
                    else if (elemBelow == menuWord) {
                        enterDroppable(menuWord, 'white');
                        currentDroppable = menuWord;
                        editRes(word, false); // убрать слово из вывода
                    }
                    // обработка выхода за рамки
                    else if (elemBelow != droppableField){
                        checkOutOfBounds(word, droppableField);
                    }
                }
                else if (elemBelow == droppableField){
                    checkOutOfBounds(word, droppableField);
                }

                document.querySelector('.words_menu').childNodes.forEach( child =>
                    child.style.position = 'static'
                );

                document.removeEventListener('mousemove', onMouseMove);
                word.onmouseup = null;
            };

            function onMouseMove(event) {
                moveAt(event.pageX, event.pageY);
                // поиск самого верхнего элемента, над которым сейчас блок
                word.hidden = true;
                elemBelow = document.elementFromPoint(event.clientX, event.clientY);
                word.hidden = false;
                if (!elemBelow) return;
            }
        }
    )
    
    wordElems.forEach( word =>
        word.ondragstart = function() {
            return false;
        }
    )

}

function checkOutOfBounds(word, droppableField){
    let wordRect = word.getBoundingClientRect();
    let dropRect = droppableField.getBoundingClientRect();
    if (wordRect.right > dropRect.right){
        word.style.left = parseFloat(word.style.left.replace('px', '')) - (wordRect.right - dropRect.right) + 'px';
    }
    if (wordRect.bottom > dropRect.bottom){
        word.style.top = parseFloat(word.style.top.replace('px', '')) - (wordRect.bottom - dropRect.bottom) + 'px';
    }
    if (wordRect.top < dropRect.top){
        word.style.top = parseFloat(word.style.top.replace('px', '')) - (wordRect.top - dropRect.top) + 'px';
    }
    if (wordRect.left < dropRect.left){
        word.style.left = parseFloat(word.style.left.replace('px', '')) - (wordRect.left - dropRect.left) + 'px';
    }
}

function editRes(word, isLocated){
    let res = document.querySelector(".output");
    let output = word.textContent.split('-')[1].trim(); // убираем ключ
    if (isLocated){
        res.textContent += output + ' ';
    }
    else{
        res.innerHTML = res.textContent.replace(output + ' ', '');
    }
}

function getWords(){
    let inputString = document.getElementById("input").value;
    let words = inputString.split('-');
    words = words.map(element => element.trim());

    // возвращает ассоциативнй массив со словами и числами
    function getMap(){
        let wordsWithKeys = new Map;
        let arrWords = new Array();
        let arrNums = new Array();
        // собираем массивы строк и чисел
        words.forEach(word => {
            if (parseInt(word)){
                arrNums[arrNums.length] = parseInt(word);
            }
            else{
                arrWords[arrWords.length] = word
            }
        });
        arrNums = arrNums.sort();
        arrWords = arrWords.sort();
        for (let i = 0; i < arrWords.length; i++){
            wordsWithKeys.set(`a${i+1}`, arrWords[i]);
        }
        for (let i = 0; i < arrNums.length; i++){
            wordsWithKeys.set(`n${i+1}`, arrNums[i]);
        }
        return wordsWithKeys;
    }
    return getMap();
}

function showWords(words){
    let menuWord = document.querySelector(".words_menu");
    menuWord.replaceChildren();
    for (let pair of words) {
        menuWord.insertAdjacentHTML(`beforeend`,
            `<div class="word" draggable="true">${pair[0]} - ${pair[1]}</div>`);
    }
}

