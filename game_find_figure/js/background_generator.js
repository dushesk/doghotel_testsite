
let figures = ['circle', 'square', 'triangle'];
let colors = ['yellow', 'green', 'blue'];
for (let i = 0; i < 15; i++){
    let figure = figures[Math.round(Math.random()*(figures.length-1))];
    let color = colors[Math.round(Math.random()*(colors.length-1))];
    let a = Math.random()*20 + 5;
    let top = Math.random()*90;
    let right = Math.random()*90;

    if (figure == 'triangle'){
        document.querySelector('body').insertAdjacentHTML('beforeend',
        `<div class="background_figure triangle ${color}"
        style="border-left-width: ${a/1.5}vmin; border-right-width: ${a/1.5}vmin; border-bottom-width: ${a}vmin; top: ${top}vh; right: ${right}vw; z-index: 1;"></div>`)
    }
    else{
        document.querySelector('body').insertAdjacentHTML('beforeend',
        `<div class="background_figure ${figure} ${color} symmetric"
        style="width: ${a}vmin; height: ${a}vmin; top: ${top}vh; right: ${right}vw; z-index: 1;"></div>`)
    }
}

document.querySelectorAll('.background_figure').forEach(item => {
    dragNDrop(item);
});

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