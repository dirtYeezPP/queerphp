

``` css
*{
    margin: 0;
    box-sizing: border-box;
    font-family: cursive;
}

body{
    background-color: rgb(131, 103, 91);
}

header, main, footer, nav{
    border: 2px solid rgb(99, 88, 80);
    border-radius: 10px;
    min-height: 15vh;
    padding: 3%;
    background-color: rgb(218, 206, 196);
}


nav{
    display: grid;
    gap: 1rem;
}

nav a{
    text-decoration: none;
    font-size: 1.2rem;
    color: rgb(124, 102, 91);
    box-shadow: 2px 2px 2px 2px rgb(199, 189, 176);
    border-radius: 10px;
    display: grid;
    place-items: center;
    padding: 1.5%;
}

main{
    display: grid;
    place-items: center;
}


.MenuButton{
    font-size: 2.75rem;
    width: max-content;
    cursor: pointer;
}

.hidden{
    display: none;
}

img{
    width: 100%;
    display: block;
    border-radius: 10px;
}

footer{
    display: grid;
    gap: 5px;
}



@media(min-width: 800px){ 

    nav{
        grid-template-columns: repeat(7, 1fr);
    }

    #NAV, #FOOT{
        display: grid;
    }

    .MenuButton{
        display: none;
    }

    footer{
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    }

}
```

``` css
*{
    margin: 0; 
    box-sizing: border-box;
}

html{
    scroll-behavior: smooth;
}

body{
    background-color: rgb(160, 152, 142);
    display: grid;
    gap: 15px;
}


header, main, footer{

    background-color: rgb(198, 221, 198);
    padding: 3%;

}

main{
    min-height: 100vh;
}

img{
    width: 100%;
    display: block;
    object-fit: cover;
    border-radius: 3px;
    aspect-ratio: 1 / 1;
}

.card{
    text-align: center;
}

main h3{
    font-size: 1.5rem;
    text-align: center;
    z-index: 0;
}

footer{
    min-height: 10vh;
}

```

``` css
*{
    margin: 0;
    object-fit: cover;
}

html{
    scroll-behavior: smooth;
}

body{
    background-color: rgb(255, 242, 170);
}

header, main, footer{
    border: 2px solid gold;
    min-height: 10vh;
    padding: 3%;
}

a{
    text-decoration: none;
    color: goldenrod;
    box-shadow: 2px 2px 2px rgb(209, 178, 4);
    border-radius: 5px;
    padding: 0.6%;
    cursor: pointer;
}

.menu{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}

.menub{
    font-size: 1.75rem;
    max-width: max-content;
    cursor: pointer;
}

header, h1{
    text-align: center;
    font-size: 20px;
}

.hidden{
    display: none;
}

main{
    display: grid;
    grid-template-columns: 1fr 1fr;
}

img{
    width: 100%;
    display: block;
    border: 4px solid gold;
    border-radius: 20px;
    aspect-ratio: 16/9;
}

.img1{
    width: 60%;
}


.header{
    background: url(beyhe.jpg);
    opacity: 0.5;
    background-size: 100% 100%;
    background-repeat: no-repeat;
}

#back{
    opacity: 1;
    z-index: 1;
}



@media(min-width:400px){
    
}

@media(min-width: 500px){

.menub{
    font-size: 3rem;
}

h1{
    font-size: 40px;
}

a{
    box-shadow: 2px 2px 2px rgb(209, 178, 4);
    padding: 0.8%;
}

}

@media(min-width:600px){
    .hidden{
        display: contents;
    }
}
```

``` css
* {
    margin: 0;
    box-sizing: border-box;
}

body {
    background-color: rgb(41, 33, 41);
    padding: 2%;
}

html {
    scroll-behavior: smooth;
}

header,
main,
footer {
    background-color: rgb(92, 70, 92);
    padding: 3%;
    border: 2px solid rgb(0, 0, 0);
    padding: 2%;
}

main {
    min-height: 100vh;
    color: rgb(207, 168, 207);
}

main a {
    text-decoration: none;
    color: white;
    box-shadow: 1px 1px rgb(53, 24, 53);
    background-color: rgb(53, 24, 53);
}

nav {
    background-color: rgb(109, 81, 109);
    border: 2px solid rgb(0, 0, 0);
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    place-items: center;
    padding: 1%;
}

nav a {
    text-decoration: none;
    color: rgb(212, 172, 212);
    font-family: 'Courier New', Courier, monospace;
    font-size: 1.5rem;
}

a {
    text-decoration: none;
    color: rgb(212, 172, 212);
    font-family: 'Courier New', Courier, monospace;
    font-size: 1.5rem;
}

.create {
    background-color: rgb(146, 121, 146);
    border: 2px solid black;
    padding: 2%;
    display: none;
}

:target {
    display: block;
}

.createlink a {
    text-decoration: none;
    color: rgb(247, 220, 247);
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 2rem;
}
```

``` css
*{
    margin: 0;
    box-sizing: border-box;
}

html{
    scroll-behavior: smooth;
}

body{
    background-color: rgb(128, 111, 99);
}

header, main, footer{
    background-color: rgb(158, 135, 111);
    min-height: 5vh;
}

header{
    background-image: url("pics/crazy.gif");
    background-size: cover;
    opacity: 0.7;
}

img{
    width: 100%;
    object-fit: cover;
    display: block;
}

/* HEADER STUFF */
.titleBOX{
    display: grid;
    grid-template-columns: 20% 60% 20%;
    padding: 2%;
}

h1{
    text-align: center;
    font-size: 1.4rem;
    color: rgb(36, 27, 27);
}

.Hb{
    font-size: 2rem;
    max-width: max-content;
    cursor: pointer;
    border: none;
    background: none;
}

nav{
    background-color: rgb(65, 57, 57);  
    min-height: 10vh;
    padding: 2%;
}


.links a{
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    text-decoration: none;
    font-size: 1.5rem;
    color: rgb(160, 129, 129);
}

.links{
    display: grid;
    place-items: center;
}

.hiddenL{
    display: none;
}



/* MAIN STUFF */
.sectioniNm{
    display: grid;
    place-items: center;
}

.card{
    display: grid;
    place-items: center;
    grid-template-areas: 'P-T';

    background-color: rgb(190, 170, 153);
    border-radius: 8px;
    padding: 1%;
    width: 97%;
}

.imgB{
    width: 95%;
    aspect-ratio: 1 / 1;
    grid-area: P-T;
}

main img{
    height: 100%;
    border-radius: 4px;
    /* z-index: 0; */
   /*  transition: opacity 0.5s; */
    /* opacity: 1; */
}

.textB{
    grid-area: P-T;
    border-radius: 5px;
    padding: 2%;
    object-fit: cover;
    display: none;

    text-align: left;
    width: 90%;
}

.textB p{
    font-size: 1rem;
    color: rgb(255, 255, 255);
}

.Mb{
    font-size: 0.9rem;
    max-width: max-content;
    cursor: pointer;
    background-color: rgb(211, 196, 177);
    border: 1px solid rgb(121, 109, 101);
    border-radius: 4px;
    color: rgb(68, 61, 51);
}

.disappear{
    display: none;
}

.appear{
    display: block;
}




/* FOOTER STUFF */

footer{
    container: footcards / inline-size;
}

.footersec{
    display: grid;
}

.firstfootpic{
    background: url("pics/strawberrichan.jpg");
    background-repeat: repeat-x;
    background-size: contain;
}

#firstfoottext{
    background-color: transparent;
}

.firstfootpicishidden{
    display: none;
}

.footIMG{
    aspect-ratio: 1 / 1 ;
    width: 40%;
}

.footText p{
    font-size: 0.9rem;
    color: rgb(245, 229, 220);
    word-break: break-all;
}

.footText{
    background-color: rgb(129, 108, 80);
    border-radius: 5px;
    padding: 1%;
}

.footIMG img{
    border-radius: 100%;
    height: 100%;
}

.FOOTcard{
    display: grid;

    background-color: beige;
    border: 2px solid rgb(88, 77, 68);
    border-radius: 5px;
    padding: 1%;
}

.listlist{
    overflow: hidden;
    color: rgb(41, 35, 33);
    opacity: 0;
}

.hiddenlist{
    animation: infononreveal 2s linear forwards;
}

@keyframes infononreveal {

    0%{
        transform: translateX(-50px);
        opacity: 0;
        overflow: hidden;
    }

    100%{
        transform: translateX(0px);
        opacity: 1;
        height: fit-content;
        background-color: rgb(182, 166, 147);
        border-radius: 10px;
    }
    
}

@container footcards (inline-size>500px){

    .footIMG{
        width: 40%;
    }

}

@container footcards (inline-size>650px) {

    .FOOTcard{
        grid-template-columns: 30% 70%;
    }

    .footIMG{
        width: 70%;
    }

    #firstfootpic{
        display: block;
    }

    .firstfootpic{
        background-color: beige;
        background-image: none;
    }

    #firstfoottext{
        background-color: rgb(129, 108, 80);
    }

    .footersec{
        grid-template-columns: repeat(2, 50%);
    }
}



/* MEDIA QUERY */

@media (min-width:450px){
    h1{
        font-size: 1.4rem;
    }

    
}



@media(min-width: 650px){


    .titleBOX{
        grid-template-columns: 1fr;
        text-align: center;
    }

    .Hb{
        display: none;
    }

    #naV{
        display: grid;
    }

    .links{
        grid-template-columns: 1fr 1fr 1fr;
    }


    .sectioniNm{
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
    

}



@media (min-width: 800px){
    h1{
        font-size: 2.3rem;
    }

    h4{
        font-size: 1.5rem;
    }

    .footText p{
        font-size: 1.3rem;
    }
}


@media (min-width:1100px){

    .sectioniNm{
        grid-template-columns: 1fr 1fr 1fr;
    }

}

```

``` css
header, footer{
    min-height: 20vh;
    background-color: rgb(104, 86, 75);
}

header, main, footer{
    border: 2px solid rgb(75, 65, 61);
    padding: 2%;
}
main{
    min-height: 80vh;
    background-color: rgb(138, 116, 102);
}

html{
    scroll-behavior: smooth;
    margin: 0;
    box-sizing: border-box;
}

footer div{
    border: 1px solid black;
    padding: 3%;
    text-align: center;
}

footer a{
    margin: auto;
}

a{
    text-decoration: none;
    font-size: 40px;
    color: black;
    background-color: bisque;
    padding: 2%;
    border-radius: 10px;
    font-family: sans-serif;
}

nav{
    padding: 4%;
    text-align: center;
}

main .wow{
    text-align: center;
    font-family: cursive;
    padding: 4%;
    border: 1px solid rgb(34, 29, 29);
    border-radius: 10px;
}

main img{
    width: 100%;
    display: block;
    border: 2px solid whitesmoke;
    border-radius: 10px;
}

.top{
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    background-color: aliceblue;
    border-radius: 10px;
    font-size: 10px;
}


@media(min-width: 650px){
    main{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }
    
    footer{
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
    
    }
```

``` css
header, main, footer{
    border: 2px solid rgb(11, 23, 46);
    padding: 3%;
}

header, footer{
    min-height: 20vh;
    background-color: rgb(107, 171, 223);
}

main{
    min-height: 90vh;
    background-color: rgb(184, 221, 235);
}

footer{
    font-style: oblique;
    text-align: center;
}

*{
    margin: 0;
    text-align: center;
}

nav{
    padding: 4%;
    border: 2px solid rgb(21, 48, 56);

}

nav a{
    color: rgb(7, 39, 37);
    text-decoration: none;
    font-size: 20px;
    padding: 1%;
    background-color: rgb(220, 255, 255);
    font-style: oblique;
}

img{
    width: 100%;
    height: 100%;
    align-items: center;
}

div{
    width: 70%;
    margin: auto;
    background-color: rgb(126, 211, 211);
    padding: 5%;
    border: 2px solid rgb(45, 145, 131);
}

html{
    scroll-behavior: smooth;
}


.inner{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    gap: 8px;
    text-align: center;
}

.inner a{
    font-size: 25px;
    font-style: oblique;
   text-decoration: none;
   text-align: center;
    
}

.inner div{
    width: 100%;
    text-align: center;

}


```

``` css
body{
    background-color: rgb(0, 0, 0);
}

img{
    width: 100%;
    height: 100%;

}

img {
    transition: transform .7s ease-in-out;
  }
  
  img:hover {
    transform: rotate(360deg);
    animation-delay: 1s;
  }

div{
    width: 99%;
    margin: auto;
}

h2{
    background-color: aliceblue;
    font-size: 40px;
}

a{
    font-size: 30px
}

section{
    width: 90%;
    margin: auto;
    
}
```

``` css
video {
    transition: transform .7s ease-in-out;
  }
  
  video:hover {
    transform: rotate(360deg);
    animation-delay: 1s;
  }
```

``` css
*{
    margin: 0;
    box-sizing: border-box;
}

html{
    scroll-behavior: smooth;
}

body{
    background-color: rgb(66, 63, 61);
}

header, main, footer{
    background-color: rgb(121, 118, 115);
    min-height: 5vh;
}

.titleBOX{
    display: grid;
    grid-template-columns: 20% 60% 20%;
    padding: 2%;
}

.Hb{
    font-size: 3rem;
    max-width: max-content;
    cursor: pointer;
    border: none;
    background: none;
}

.Mb{
    font-size: 0.9rem;
    max-width: max-content;
    cursor: pointer;
    background-color: rgb(194, 185, 174);
    border: 1px solid rgb(121, 109, 101);
    border-radius: 4px;
}

nav{
    background-color: rgb(65, 57, 57);  
    min-height: 10vh;
    padding: 2%;
}

.links a{
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    text-decoration: none;
    font-size: 1.5rem;
    color: rgb(102, 88, 88);
}

.links{
    display: grid;
    place-items: center;
}

.hiddenL{
    display: none;
}


h1{
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 1rem;
    text-align: center;
}

.sectioniNm{
    display: grid;
    place-items: center;
}

.card{
    display: grid;
    place-items: center;
    grid-template-areas: 'P-T';
    background-color: rgb(150, 144, 144);
    width: 97%;
    border-radius: 8px;
    padding: 1%;
}

.imgB{
    width: 95%;
    aspect-ratio: 1 / 1;
    grid-area: P-T;
}

main img{
    height: 100%;
    border-radius: 4px;
    /* z-index: 0; */
    transition: opacity 0.5s;
    opacity: 1;
}

img{
    width: 100%;
    object-fit: cover;
    display: block;
}

.textB{
   /*  z-index: 1; */
    grid-area: P-T;
    border-radius: 5px;
    padding: 1%;
    object-fit: cover;
    display: none;
}


p{
    font-size: 1rem;
    color: rgb(53, 37, 23);
}

.textB .diffC{
    color: rgb(104, 28, 28);
    font-size: 1rem;
}

.textB{
    text-align: left;
    width: 90%;
}

.disappear{
    display: none;
}

.appear{
    display: block;
}

.footersec{
    display: grid;
    grid-template-columns: repeat(2, 50%);
}

.footIMG{
    aspect-ratio: 1 / 1 ;
    width: 40%;
}

.footText{
    width: 50%;
}

.footIMG img{
    border-radius: 100%;
    height: 100%;
}

.FOOTcard{
    display: grid;
    grid-template-columns: 100% 100%;
    container: F-C / inline-size;

    background-color: beige;
    border: 2px solid rgb(88, 77, 68);
    border-radius: 5px;
    padding: 1%;
    
}



@container F-C(inline-size<200px){
    .footersec .FOOTcard{
        width: 100%;
    }
}




@media (min-width:450px){
    h1{
        font-size: 1.4rem;
    }

    .footIMG{
        width: 70%;
    }
}

@media(min-width: 650px){

    #naV{
        display: grid;
    }

    .links{
        grid-template-columns: repeat(3, 1fr);
    }

    .sectioniNm{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }

    main{
        display: grid;
    }
    
    
    .FOOTcard{
        grid-template-columns: 30% 70%;
    }

    .footIMG{
        width: 80%;
    }

}

@media (min-width: 800px){
    h1{
        font-size: 2.3rem;
    }
}

```


``` css
*{
    margin: 0;
    box-sizing: border-box;
}

body{
    background-color: rgb(66, 63, 61);
}

.title{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}

h1{
    text-align: center;
}

button{
    background: none;
    font-size: 2rem;
    max-width: max-content;
    cursor: pointer;
    border: none;
}

nav{
    display: grid;
    grid-template-columns: 1fr 1fr;
    text-align: center;
    transition: opacity 1s; 
    overflow: hidden;
}

.hidden{
    opacity: 0;
    height: 0;
}

a{
    text-decoration: none;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    color: rgb(27, 0, 0);
}

section{
    background-color: rgb(245, 233, 220);
    padding: 2%;
}

video{
    border-radius: 10px;
    width: 100%;
} 

.card{
    padding: 2%;
    background-color: rgb(160, 141, 133);

    display: grid;
    place-items: center;
}

footer{
    padding: 2%;
    background-color: rgb(196, 169, 146);
    border: 2px solid rgb(71, 65, 59);
    border-radius: 5px;
}


@media (min-width:700px){

    h1{
        font-size: 4rem;
    }

    h3{
        font-size: 2rem;
    }

    h4{
        font-size: 1.8rem;
    }

    button{
        font-size: 3.9rem;
    }

    a{
        font-size: 2.7rem;
    }

    li{
        font-size: 2rem;
    }

}


@media (min-width: 1300px){

    h1{
        font-size: 6rem;
    }

    header{
        grid-template-columns: 1fr;
        text-align: center;
    }

    h3{
        font-size: 3rem;
    }

    h4{
        font-size: 2.6rem;
    }

    button{
        display: none;
    }

    #NA{
        display: block;
        transition: none;
    }



}

```


``` css
/* 1. BASE RESET: Makes sizing predictable and removes default margins */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f4f4f8; /* Soft off-white */
    color: #333;
    line-height: 1.6;
}

/* 2. HEADER & NAV (Mobile First) */
header {
    background-color: white;
    padding: 15px 20px;
    border-bottom: 3px solid #6a0dad; /* Purple accent */
    text-align: center;
}

nav {
    display: flex;
    flex-direction: column; /* Stacks links vertically on mobile */
    gap: 15px;
    margin-top: 10px;
}

nav a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

nav button {
    background-color: #6a0dad;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

/* 3. MAIN CONTAINER & FORMS */
main {
    padding: 20px;
    max-width: 400px; /* Keeps forms from getting too wide on desktop */
    margin: 0 auto;   /* Centers the main container */
}

/* This fixes the side-by-side inputs in your screenshot */
form {
    display: flex;
    flex-direction: column; 
    gap: 15px; 
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

/* 4. INPUTS & BUTTONS */
input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    /* 16px is critical for mobile: it stops iPhones from auto-zooming when tapping an input */
    font-size: 16px; 
}

input:focus {
    outline: none;
    border-color: #6a0dad;
}

button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #6a0dad;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}

/* 5. UTILITIES */
.hidden {
    display: none !important;
}

footer {
    text-align: center;
    padding: 20px;
    font-size: 0.9rem;
    color: #777;
}

/* 6. MEDIA QUERIES (Desktop Adjustments) */
/* When the screen is wider than 600px, the nav changes to a horizontal row */
@media (min-width: 600px) {
    nav {
        flex-direction: row;
        justify-content: center;
        gap: 30px;
    }
}



.registerFormDiv, .loginFormDiv, .createFormDiv {
    background: white;
    width: 100%; /* Makes it take full width of its container on mobile */
    max-width: 400px; /* Stops it from stretching too wide on desktop */
    margin: 0 auto 40px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}
```


``` css
:root {
    --card-background: rgb(209, 201, 185);  
    --text-color: rgb(61, 45, 11); 
    --body-background: rgb(179, 167, 160); 
}

* {
    margin: 0; 
    padding: 0; 
    box-sizing: border-box;
}

body {
    background-color: var(--body-background);
    color: var(--text-color);
}

.hidden {
    display: none !important; 
}'

#F7FCFE

#E9DFBE
#E8D5BE

header {
    background-color: var(--body-background);
    border-bottom: 3px solid var(--text-color);
    text-align: center; 
    padding: 15px 20px; 
}

nav {
    display: flex; 
    flex-direction: column; 
    gap: 15px; 
    margin-top: 10px; 
}

nav a {
    text-decoration: none;
    color: var(--text-color);
    font-weight: bold; 
}

nav button {
    background-color: var(--card-background);
    border: none; 
    color: var(--text-color);
    padding: 10px; 
    border-radius: 6px; 
    font-weight: bold; 
    cursor: pointer; 
}

main {
    padding: 20px; 
    margin: 0 auto; 
}

/* Merged the conflicting form blocks into one clean set of rules */
#registerFormDiv, #loginFormDiv, #createFormDiv {
    display: flex; 
    flex-direction: column;
    gap: 15px;
    background-color: var(--card-background);
    width: 100%; 
    max-width: 400px;
    margin: 0 auto 40px auto;
    padding: 30px; 
    border-radius: 10px; 
    box-shadow: 0 4px 10px var(--text-color); 
}

input {
    width: 100%; 
    padding: 12px; 
    border: 1px solid #ccc; 
    border-radius: 6px;
    font-size: 16px; 
}

input:focus {
    outline: none;
    border-color: var(--text-color); 
}

button[type="submit"] {
    width: 100%; 
    padding: 12px; 
    background-color: var(--body-background);
    color: var(--text-color);
    border: 1px solid var(--text-color); 
    border-radius: 6px; 
    font-size: 16px; 
    font-weight: bold; 
    cursor: pointer; 
}

.podium {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.poem-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: transform 0.2s;
    display: flex;
    flex-direction: column;
}

.poem-card:hover {
    transform: translateY(-5px);
}

.pImg img {
    width: 100%;
    height: 200px;
    object-fit: cover; 
    border-bottom: 3px solid var(--text-color);
}

.poem-card h3 {
    margin: 15px 15px 5px 15px;
    font-size: 1.2rem;
    color: #222;
}

.poem-card p {
    margin: 0 15px 10px 15px;
    font-size: 0.95rem;
    color: #555;
}

.poem-card p:nth-of-type(2) {
    flex-grow: 1; 
    font-style: italic;
    color: #333;
}

footer {
    text-align: center;
    padding: 20px; 
    font-size: 0.9rem;
    color: #777;  
}

@media (min-width: 600px) {
    nav {
        flex-direction: row;
        justify-content: center;
        gap: 30px;
    }
}
```



``` php
<div class="menu-container">
  <details class="dropdown">
    <summary class="dots-btn" aria-label="Post actions">⋮</summary>
    <div class="poemButtonsDiv">
      <button type="button">Edit Post</button>
      <button type="button">Delete Post</button>
    </div>
  </details>
</div>
```

``` css
.menu-container {
  position: relative;
  display: inline-block;
}

/* Remove default disclosure triangle */
.dropdown summary {
  list-style: none;
  cursor: pointer;
  font-size: 1.25rem;
  padding: 4px 8px;
  user-select: none;
}

.dropdown summary::-webkit-details-marker {
  display: none;
}

/* Position the popup menu */
.poemButtonsDiv {
  position: absolute;
  right: 0;
  top: 100%;
  margin-top: 4px;
  background-color: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  min-width: 130px;
  z-index: 10;
  overflow: hidden;
}

.poemButtonsDiv button {
  background: none;
  border: none;
  padding: 10px 14px;
  text-align: left;
  cursor: pointer;
  font-size: 0.9rem;
}

.poemButtonsDiv button:hover {
  background-color: #f1f5f9;
}
```

``` php
<div class="menu-container">
  <button type="button" class="dots-btn" aria-label="Post actions">⋮</button>
  <div class="poemButtonsDiv hidden">
    <button type="button">Edit Post</button>
    <button type="button">Delete Post</button>
  </div>
</div>
```

``` css
.menu-container {
  position: relative;
  display: inline-block;
}

.dots-btn {
  background: none;
  border: none;
  font-size: 1.25rem;
  cursor: pointer;
  padding: 4px 8px;
  border-radius: 4px;
}

.dots-btn:hover {
  background-color: rgba(0, 0, 0, 0.05);
}

.poemButtonsDiv {
  position: absolute;
  right: 0;
  top: 100%;
  margin-top: 4px;
  background-color: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  min-width: 130px;
  z-index: 10;
  overflow: hidden;
}

/* Utility to hide the dropdown */
.hidden {
  display: none !important;
}

.poemButtonsDiv button {
  background: none;
  border: none;
  padding: 10px 14px;
  text-align: left;
  cursor: pointer;
  font-size: 0.9rem;
}

.poemButtonsDiv button:hover {
  background-color: #f1f5f9;
}
```

``` js
// Toggle menu on dot button click
document.addEventListener('click', (e) => {
  const isDotsBtn = e.target.matches('.dots-btn');
  
  // Close any other open menus first
  document.querySelectorAll('.poemButtonsDiv').forEach(menu => {
    if (!isDotsBtn || menu !== e.target.nextElementSibling) {
      menu.classList.add('hidden');
    }
  });

  // Toggle current menu if dot button was clicked
  if (isDotsBtn) {
    const menu = e.target.nextElementSibling;
    menu.classList.toggle('hidden');
  }
});



$(document).on('click', function(e) {
  const $clickedBtn = $(e.target).closest('.dots-btn');

  if ($clickedBtn.length) {
    // Find the menu next to the clicked button
    const $currentMenu = $clickedBtn.next('.poemButtonsDiv');
    
    // Hide all other open menus on the page
    $('.poemButtonsDiv').not($currentMenu).addClass('hidden');
    
    // Toggle the clicked menu
    $currentMenu.toggleClass('hidden');
  } else {
    // If the user clicks anywhere else on the document, close all menus
    $('.poemButtonsDiv').addClass('hidden');
  }
});


$(document).ready(function() {
    $(document).on('click', '.deletePostBtn', function(e) {
        e.preventDefault(); // Good practice to prevent default button behavior
        
        // Grab the ID from the data-id attribute of the clicked button
        const poemId = $(this).data('id');
        
        console.log("The ID for this poem is:", poemId);
        
        // Now you can do your AJAX call and send poemId to the server
        /*
        $.ajax({
            url: 'delete_poem.php',
            method: 'POST',
            data: { id: poemId },
            success: function(response) {
                // handle success
            }
        });
        */
    });
});
```