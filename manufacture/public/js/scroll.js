document.addEventListener('DOMContentLoaded', () => {
    const onScrollHeader = () => { // объявляем основную функцию onScrollHeader
        const header = document.getElementById('home-navbar') 
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

document.querySelector('html').style = "scroll-behavior: smooth";