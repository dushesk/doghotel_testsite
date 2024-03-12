
let select = document.querySelector('#select');

function showImage(src) {
    document.getElementById("formula").remove();
    var img = document.createElement("img");
    img.src = src;
    img.id = "formula"
    document.getElementById("conteiner").appendChild(img);
}

select.addEventListener('change',function(){
    showImage("styles/images/js_task_images/formula_"+select.value+".jpg")
});

document.querySelector("#button").onclick = function(){
    let numFormula = select.value;
    
    do{
        if (numFormula == 1) {
            input = prompt("Формула 1. Введите значения a, b и c через пробел");
            nums = input.split(' ').map(Number);
            res = formula_1(nums[0],nums[1],nums[2]);
        }
        else if (numFormula == 2) {
            input = prompt("Формула 2. Введите значения a, b и c через пробел");
            nums = input.split(' ').map(Number);
            res = formula_2(nums[0],nums[1],nums[2]);
        }
        else if (numFormula == 3) {
            input = prompt("Формула 3. Введите значения a, b и c через пробел");
            nums = input.split(' ').map(Number);
            res = formula_3(nums[0],nums[1],nums[2]);
        }
        else {return;}
        contin = confirm("Ответ: " + res + "\nПродолжаем?");
        
        numFormula++;
    }while(contin)
}


let formula_1 = function(a, b, c){
    let res = Math.PI*Math.abs(a)/(b*b*c);
    return res;
}

let formula_2 = function(a, b, c){
    let res = Math.pow((a + Math.sqrt), 2)/Math.pow(c,3);
    return res;
}

let formula_3 = function(a, b, c){
    let res = Math.sqrt(a + b + Math.sqrt(c))/(Math.PI*b);
    return res;
}