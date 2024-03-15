
document.querySelector("body").insertAdjacentHTML(
    'afterbegin',
    `<header class="header_wrapper">
        <div class="logo_wrap">
            <img src="styles/images/logo.svg" width="50px" height="50px"/>
            <a href="index.html" class="logo">Dog Hotel</a>
        </div>
        
        <nav>
            <div class="wrap_a">
                <a href="server_programming/index.php">Services</a>
                <div class="underline"></div>
            </div>
            <div class="wrap_a">
                <a href="content.html">Content</a>
                <div class="underline"></div>
            </div>
            <div class="wrap_a">
                <a href="test/index_test.html">Test</a>
                <div class="underline"></div>
            </div>
            <div class="wrap_a">
                <a href="about_us.html">About us</a>
                <div class="underline"></div>
            </div>
        </nav>
    </header>`
);

document.addEventListener('DOMContentLoaded', () => {
    const onScrollHeader = () => { // объявляем основную функцию onScrollHeader
        const header = document.querySelector('header') 
        let prevScroll = window.pageYOffset 
        let currentScroll // на сколько прокручена страница сейчас (пока нет значения)
    
        window.addEventListener('scroll', () => { // при прокрутке страницы
    
            currentScroll = window.pageYOffset // узнаем на сколько прокрутили страницу
    
            const headerHidden = () => header.classList.contains('header_hidden') // узнаем скрыт header или нет
    
            if (currentScroll > prevScroll && !headerHidden()) { // если прокручиваем страницу вниз и header не скрыт
                header.classList.add('header_hidden') // то скрываем header
            }
            if (currentScroll < prevScroll && headerHidden()) { // если прокручиваем страницу вверх и header скрыт
                header.classList.remove('header_hidden') // то отображаем header
            }
    
            prevScroll = currentScroll // записываем на сколько прокручена страница на данный момент
        })
  
    }
  
    onScrollHeader() // вызываем основную функцию onScrollHeader
  
});
  
  