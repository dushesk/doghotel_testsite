
document.querySelector('.conteiner').insertAdjacentHTML('beforeend',
    `<div class='scroll_stats'> ${ showUsersScore() } </div>`
);

function showUsersScore(){
    let users = getUsers();
    users.sort(function(a, b){
        return sum(b.scores) - sum(a.scores);
    });

    return users.map(
        (user) => `<div class="user"> ${showInfo(user)} </div>`
    ).join('');
}

function showInfo(user){
    let scores = user.scores.split(',');
    return `
        <h3> ${user.name} </h3>
        <div class='wraper'>
            ${scores.map( (item,index) => `<h>Уровень ${index+1}: ${item||0} </h>
            <div style="width: 15px; margin: 0 5px; fill: rgb(250, 250, 49)">${setStar()}</div>`).join('')}
        </div>
        `
}

function getUsers(){
    localStorage.removeItem('last_player');
    localStorage.removeItem('last_level');
    localStorage.removeItem('theme');
    let arr = [];
    let name;
    for (let i = 0; i < localStorage.length; i++){
        name = localStorage.key(i);
        arr.push({ name: name, scores: localStorage.getItem(name) });
    }
    return arr
}

function sum(arr){
    arr = arr.split(',');
    arr = arr.map(item => +item);
    return arr.reduce((partialSum, a) => partialSum + a, 0);
}

function setStar(){
    return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 314.2 300" >
    <path d="m 154.98648,0.03060636 c -21.9352,1.28471804 -21.6742,30.50653664 -28.3309,46.01011664 -4.8695,17.660145 -9.6566,35.342879 -14.4903,53.012859 -32.968013,1.228698 -66.380713,-3.50797 -99.067913,0.23492 -15.9110996,7.263138 -18.2493996,30.799628 -1.8845,39.187318 22.9213,17.76822 48.0786,32.38095 72.1217,48.54431 -9.7158,32.01764 -27.8488,62.13326 -31.5348,95.57907 3.1518,17.13656 26.2807,23.22208 38.2577,10.37166 22.927913,-15.1548 42.874413,-35.89141 65.733713,-50.17378 29.4573,15.19591 50.534,43.9205 81.0388,56.93158 18.0462,2.92639 33.0142,-18.43781 22.1775,-34.23209 -8.5419,-26.53566 -19.294,-52.28093 -29.1453,-78.34149 27.1664,-19.52736 59.3715,-33.60037 82.2534,-58.23617 8.2054,-17.71997 -9.832,-36.045578 -28.0408,-31.192818 -27.2037,-0.58906 -54.9526,3.206898 -81.7937,1.84732 -11.5503,-31.195047 -13.7827,-66.562092 -31.7546,-94.9292986 -3.9737,-4.22550404 -10.0754,-4.80144004 -15.54,-4.61350704 z"></path></svg>`;
}

