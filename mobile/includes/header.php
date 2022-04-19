<?php
include 'includes/session.php';
?>
<!doctype html>
<html lang="en" style="overflow-x: hidden;">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="saas_style.scss" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css'>
    <link href="../bower/fontawesome/css/all.css" rel="stylesheet">
    <link href="../bower/fontawesome/css/fontawesome.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/6ba6dd3935.js"></script>
    <link href="../bower/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../bower/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!---international block--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <title>UkrZmi</title>
    <!-------------------JQUERY SCRIPTS------------------------------------------->
<!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
 
    <style>
      body{
        width: 100%;
        overflow-x: hidden;
      }
      	 .titleMod{
          display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;  
		  }
    /* width */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #0057b7;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #023873;
    }

    ::-moz-selection {
        /* Code for Firefox */
        color:  #0057b7;
        background: #ffcc00;
    }

    ::selection {
        color:  #0057b7;
        background: #ffcc00;
    }

.hideSpace{
display: none;
background-color: #000000;
}
.showSpace{
  background-color: #FFFFFF;
}
    .newsContainer {
  margin-left: auto;
  margin-right: auto;
  width: 1280px!important;
        max-width: 100%;


    }
.topRow{

  width: 100%;
 overflow-x: hidden;
}
.homeContent{
  justify-content: center;
}
.topContent{
  width:100%;
}
    .cardBlock {
        width: 100%;
     
    }


    
/*//////////////////////////////////////////////////////////////////////////////////////*/
    .imgTitle {
        position: relative;
        width: 40%;
    }
    .imgTitle_fc {
        position: relative;
        width: 100%;
    }
    .imgTitle_2 {
        position: relative;
    }
  .cardHr{
    border: 1px solid #8A8686;
    color: #8A8686;
    margin-bottom: -6px;
    margin-top: 6px;
  }
.cardDesc{
  width: 60%;
  padding-left: 5px;
}
    .blogTitle {
        margin: 0;
        text-align: left;
        letter-spacing: 2px;
        color: #252525;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.7);
        font-size: 12px!important;
        height: 18px;
        top: 0;
        font-weight: normal;
        padding: 0 10px 2px 6px;
        font-family: Roboto;
    }
.blogTitle_2{
  margin: 0;
        text-align: center;
       line-height: 2;
        color: #fff;
        position: absolute;
        background-color: rgba(0, 0, 0, 0.8);
        border: none;
        border-radius: 10px;
        height: 50px;
        top: 5px;
        right: 0;
        font-weight: normal;
        padding-right: 13px;
        padding-top: 13px;
        font-family: Roboto;
        font-size: 11px!important;
        width: 60px;
}
.intBadge{
  margin: 0;
        text-align: left;
        letter-spacing: 1px;
        color: #252525;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.7);
        display: flex;
        height: 24px;
        margin-top: 60px;
        font-weight: normal;
        padding: 3px 0 3px 3px;
        font-family: Roboto;
        width:100%;
        
}
.bd_1{
       width:55%;
       white-space: nowrap;
        overflow-x: hidden;
        font-size: 11px;
}
.bd_2{
       width:40%;
       white-space: nowrap;
        overflow-x: hidden;
        font-size: 11px;
}
.cardFrame{
        margin: 0;
        text-align: left;
        letter-spacing: 2px;
        color: #252525;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.0);
        border: solid;
        height: 95px;
        width: 100%;
        top: 0;
        font-weight: normal;
        padding: 0 10px 2px 6px;
        font-family: Roboto;
        
}
.cardFrame_2{
  margin: 0;
        text-align: left;
        letter-spacing: 2px;
        color: #252525;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.0);
        border: solid;
        height: 100px;
        width: 90%;
        top: 0;
        font-weight: normal;
        padding: 0 10px 2px 6px;
        font-family: Roboto;
}
.cardFrame_3{
  margin: 0;
        text-align: left;
        letter-spacing: 2px;
        color: #252525;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.0);
        border: solid;
        height: 95px;
        width: 100%;
        top: 0;
        font-weight: normal;
        padding: 0 10px 2px 6px;
        font-family: Roboto;
}
.cardFrame_4{
  margin: 0;
        text-align: left;
        letter-spacing: 2px;
        color: #252525;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.0);
        border: solid;
        height: 100px;
        width: 90%;
        top: 0;
        font-weight: normal;
        padding: 0 10px 2px 6px;
        font-family: Roboto;
}
.voiceCard{
  border: solid 2px #C4C4C4;
  border-radius: 25px;
  height: 240px;
  padding: 1px;
  width: 100%;
}
.voiceCard h6{
font-size: 18px;
color: darkolivegreen;
}
.voiceCard_2{
  border: solid 2px #C4C4C4;
  border-radius: 15px;
  height: 80px;
  padding: 1px;
  width: 100%;
}
.btn:focus {
  box-shadow : none !important;
}
.fcIcon{
        margin: 0;
        text-align: left;
        letter-spacing: 2px;
        color: #252525;
        position: absolute;
        color: white;
        height: 24px;
        top: 0;
        font-weight: normal;
        padding: 75px 10px 2px 6px;
        font-family: Roboto;
}
.fcIconVid{
  margin: 0;
        text-align: left;
        letter-spacing: 2px;
        color: white;
        position: absolute;
       font-size: 20px;
        height: 24px;
        top: 0;
        font-weight: normal;
        padding: 65px 10px 2px 6px;
        font-family: Roboto;
}
    .imgTitle img {
        height: 100px;
        width: 100%;
    }
    .imgTitle_2 img {
        height: 100px;
        width: 100%;
    }  
    .titleBadge{
      width: 20px;
      float: left;
      margin-top: 2px;
      margin-right: 1px;
    }
    .newsCard{
      width:50%!important;
    }
    .cardBlock button{
      margin-bottom: 20px;
    }
    .cardHead {

        width: 208px;
        margin: 0px auto;
        font-weight: 600;
        font-size: 15px;
        line-height: 18px;
        color: #000000;
        height: 35px;
        overflow-y: hidden;
    }
    .cardHead_fc {
width: 100%;
font-weight: 600;
font-size: 15px;
color: #000000;
overflow-y: hidden;
}
    .shareIcon{
      float:right;
      margin-right: 5px;
      padding-left: 20px;
    }
.blockTitle{
  font-size: 14px;
  text-align: left;
  font-weight: 500;
  width:100%;
}
.cardRow{
  font-size: 13.5px;
  position: relative;
}
.cardSet{
  margin-bottom: 10px;
}
.blockCard{
  margin: 0px;
}
.card{
  padding: 2px!important;
  border: none;
}
.clearfix {
  overflow: auto;
}
.cardPhoto_3 {
        height: 100px!important;
        width: 100%;
        background-image: url('images/placeholder.png') no-repeat;
        background-size: 100%;
        
    }
.cardPhoto_2 {
        height: 95px!important;
        width: 100%;
        background-image: url('images/placeholder.png') no-repeat;
        background-size: 100%;
        
    }
    .cardPhoto {
        height: 130px!important;
        width: 100%;
        background-image: url('images/placeholder.png') no-repeat;
        background-size: 100%;
        object-fit: cover;
    }
    .cardPhoto_fc {
        height: 130px!important;
        width: 100%;
        background-image: url('images/placeholder.png') no-repeat;
        background-size: 100%;
        object-fit: cover;
    }
    .cardPhoto_head{
      height: 200px!important;
        width: 100%;
        background-image: url('images/placeholder.png') no-repeat;
        background-size: 100%;
        object-fit: cover;
    }
    .cardPhotoList {
        height: 150px!important;
        width: 100%;
        background-image: url('images/placeholder.png') no-repeat;
        background-size: 100%;
        object-fit: cover;
    }
    .cardPhotoList_2 {
        height: 90px!important;
        width: 100%;
        background-image: url('images/placeholder.png') no-repeat;
        background-size: 100%;
        object-fit: cover;
    }
    .cardFoot {
        position: absolute;
    }

    .ellipBox {
        float: right;
        width: 5px;
       margin-right: 5px;
       padding-left: 10px;
    }

    .cardEllip {
        width: 5px;
        height: 5px;
        background: #C4C4C4;
        border-radius: 50%;
        margin-top: 7px;
    }

    .cardCat {
        font-style: normal;
        font-weight: normal;
        font-size: 13px;
        color: #8A8686;
        
    }

    .cardTime {
        float: right;     
        margin-right: 15px;
  padding-left: 8px;
    }

    .cardCategory {   
      float: left;   
        padding-right: 0px!important;
    }
  .cardLink{
    text-decoration:none;
  }
  .cardLink:hover{
    text-decoration:none;
    color:#0057b7!important;
  }
    .newsHead {
        font-style: normal;
        font-weight: 500;
        font-size: 22px;
        line-height: 26px;
        margin-left: 0px;
        color: #000000;
    }

    .topBlockA {
        height: 46px;
        background: #0057b7;
        overflow-x: hidden;
        width: 100%;
        margin-top: auto;
        margin-bottom: auto;
    }

    .topBlockA_1 {
        height: 47px;
        background: #ffcc00;
        transform: skew(-20deg);
        width: 100%;
    }

    .topBlockA_1_text {
        transform: skew(20deg);
        text-align: center;
        padding-top: 10px;
        font-weight: 400;
    }

    .tobBlockB {
        height: 7px;
        background: #ffcc00;
        overflow-x: hidden;
        width: 100%;
    }

    .topLogo {
        background-color: #000000;
        border-radius: 5px;
        color: azure;
        margin-top: 4px;
        margin-bottom: 4px;
        height: 39px;
        width: 39px;
        margin-left: 20px;
        text-align: center;
        padding-top: 3px;
        font-size: 22px;
    }

    .topLogoText {
        margin-top: 10px;
    }

    .topSearch {
        padding-top: 7px;
    }

    .topNav {
        padding-top: 1px;
        padding-bottom: 4px;
    }
.feedbackRow{
  margin-top: -30px;
}
.listImage{
  width:95%!important;
  height:80px!important;
}
    .navLink {
        font-size: 12px;
        padding-left: 8px;
        padding-right: 8px;
        padding-top: 2px;
        padding-bottom: 0px;
        font-weight: 600;
    }

    #linkActive {
        border-bottom: solid #000000;
    }

    .navbarBox {
        height: 35px;
        margin-top: -8px;
    }

    .pageCat {
        font-size: 18px;
        font-weight: 500;
        margin-top: 15px;
        margin-left: 5px;
    }
    .searchHead{
 font-family: Arial, Helvetica, sans-serif;
 font-size: 20px;
 color: #1a0dab;
 padding-bottom: 0px;
 margin-bottom: 0px;
 font-weight: 400;
 line-height: 1.3;
 margin-bottom: 5px;
}
.searchCont{
  font-size: 13px;
}
    .navbarBottom {
        margin-top: 13px;
  margin-bottom: -20px;
  overflow-y: hidden;
  overflow-x: scroll;
    }
 
.border-bottom-4{
  border-bottom:solid 4px #0057b7 ;
 border-bottom-left-radius: 1.5px;
 border-bottom-right-radius: 1.5px;
 padding-bottom: 2px!important;
 margin-bottom: 0px;
 z-index: 100;
 position: absolute;
}
.navLink{
  padding-bottom: 0px;
}   
.navTopp{
  position: relative;
  width: 100%;
  overflow-x: hidden;
} 
.navTopp .navLink{
  position: relative;
} 
.navbarHr {
        width: 99%;
        border: 1.5px solid;
        border-radius: 1.5px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: -5px;
    }
.nav{
  margin-bottom: 0px!important;
}
.offcanvas{
  width: 98%!important;
  overflow-x: hidden;
}


    .cardColumn_2 {
        width: 100%;
    }

    .cardColumn {
        padding-right: 5px;
        width: 900px;
        overflow-x: hidden;
    }
    .catColumn {
        padding-right: 35px;
        width: 900px;
        overflow-x: hidden;
    }
  .catTime{
    font-size: 12.1px;
  }
  .catTime .vr{
   margin-left: 6px;
   margin-right: 5px;
    padding-right: 2px;
    height: 18px;
  }
  .catCard{
    border: solid 1px;
    border-radius: 10%;
    height: 300px;
    margin-left: 20px;
  }
  .catImgRow{
    display: flex;
    justify-content: center;
    margin-top: 1px;
  }
  .catVidRow{
 
    margin-top: 15px;
    margin-bottom:5px;
    width: 100%;
  }
  .catVidRow iframe{
    height:200px;
    width: 100%;
  }
  .w-33{
    width:33%;
    max-width: 33.33%;
  }
  .half-circle {
    width: 50px;
    height: 25px; /* as the half of the width */
    border-top-left-radius: 55px;  /* 100px of height + 10px of border */
    border-top-right-radius: 55px; /* 100px of height + 10px of border */
    border: 10px solid gray;
    border-bottom: 0;
    text-align: center;
     font-weight: 900;
     font-size: 14px;
    margin-top: 3px;
    border-left-color: orange;
    border-top-color: orange;
    border-right-color:#C4C4C4;
    padding-top: 8px;
    font-style: italic;
    
}
.half-circle-text{
  text-align: center;
  font-size: 10px;
  padding-top: 10px;
}
.authorName{
  margin-top: 15px;
  font-size: 18px;
  font-weight: 500;
  overflow-x: hidden;
  width: 100%;
  white-space: nowrap;
}
.authorScore{
  font-size: 15px;
 font-weight: 500;
}

.authorScore_icon{
    border: solid 1px #0057b7;
  border-radius: 50%;
width:25px;
 text-align: center;
}
.catCardImage{
  margin-top: 10px;
  width: 40px !important;
  height: 40px !important;
  margin-left: 10px;
  border: 2px solid gray;
  border-radius: 50%;
}
.catContent{
  margin-top: 10px;
}
.article_content iframe{
width: 100%!important;
max-width: 100%;
height:240px!important;
}
.article_content img{
width: 100%!important;
max-width: 100%;
height:240px!important;
}
.catTool{
margin-top: -18px;
}
.articleImage{
  width: 100%;
  height: 240px;
}
    .pageDesc {
        font-size: 16px;
        font-weight: 500;
        text-align: right;
        font-style: italic;
        margin-top: 15px;
        margin-right: 15px;
        padding-right: 10px;
        width: 100%;
       font-family: 'Times New Roman', Times, serif;
    }

    .adNav {
        font-size: 15px;
        padding-left: 0px;
    }

    .adNavLink {
        font-size: 12px;
        padding-left: 10px;
        padding-right: 10px;

    }
.evalMes{
  width: 10px; 
  height:20px
}
    .adNavContent {
        height: 248px;
        overflow-y: scroll;
    }
    .specialBanner{
      background-color: bisque;
      height: 130px;
    }
    .blogTitleInt {
        margin: 0;
        text-align: justify;
        color: black;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.7);
        
        height: 25px;
        bottom: 0;
        font-weight: 500;
        padding: 1px 4px 2px 4px;
        font-size: 13px;
        margin-right: 5px;
    }
    .interImage{
        width: 25px !important;
        height: 25px !important;
        margin-left: 5px;
    }
    .interImage_bottom{
      width: 25px !important;
     height: 25px !important;
     float: left;
     margin-top: 2px;
     padding-right: 3px;
    }
    .interSlideCaption{
        text-align: center;
        font-size: 13px;
        margin-top: 25px;
    }
    .horAdBanner{
        width: 100%;
        margin-top: 0px;
    }
  .autoSearch{
    padding: 25px;
    align-items: center;
    border: none;
    border-radius: 20px;
  }
.progressBar{
  border: solid 2px  #0057b7;
  border-radius: 10px;
  display: flex;
}
.progressBarContent{
  padding-left: 5px;
  padding-right: 5px;
  padding-top: 3px;
  padding-bottom: 3px;
}

.progressBarContent .vr{
width: 2px;
height: 15px;
background: #000000;
opacity: 100%;
}
.progressOne{
  float: left;
  width: 200px;
}
.progressTwo{
  float: right;
}
    </style>
   <!---international block--->
   <style>
    section {
  background: #F4F4F4;
  padding: 10px 0;
}

.container {
  width: 100%;
  max-width: 100%;
  padding: 0 1px;
}
.caroRadio{
  visibility: hidden;
}
.carousel_int {
  display: block;
  text-align: left;
  position: relative;
  margin-bottom: 22px;
}
.carousel_int > input {
  clip: rect(1px, 1px, 1px, 1px);
  clip-path: inset(50%);
  height: 1px;
  width: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
}
.carousel_int > input:nth-of-type(6):checked ~ .carousel_int__slides .carousel_int__slide:first-of-type {
  margin-left: -500%;
}
.carousel_int > input:nth-of-type(5):checked ~ .carousel_int__slides .carousel_int__slide:first-of-type {
  margin-left: -400%;
}
.carousel_int > input:nth-of-type(4):checked ~ .carousel_int__slides .carousel_int__slide:first-of-type {
  margin-left: -300%;
}
.carousel_int > input:nth-of-type(3):checked ~ .carousel_int__slides .carousel_int__slide:first-of-type {
  margin-left: -200%;
}
.carousel_int > input:nth-of-type(2):checked ~ .carousel_int__slides .carousel_int__slide:first-of-type {
  margin-left: -100%;
}
.carousel_int > input:nth-of-type(1):checked ~ .carousel_int__slides .carousel_int__slide:first-of-type {
  margin-left: 0%;
}
.carousel_int > input:nth-of-type(1):checked ~ .carousel_int__thumbnails li:nth-of-type(1) {
  box-shadow: 0px 0px 0px 5px rgba(0, 0, 255, 0.5);
}
.carousel_int > input:nth-of-type(2):checked ~ .carousel_int__thumbnails li:nth-of-type(2) {
  box-shadow: 0px 0px 0px 5px rgba(0, 0, 255, 0.5);
}
.carousel_int > input:nth-of-type(3):checked ~ .carousel_int__thumbnails li:nth-of-type(3) {
  box-shadow: 0px 0px 0px 5px rgba(0, 0, 255, 0.5);
}
.carousel_int > input:nth-of-type(4):checked ~ .carousel_int__thumbnails li:nth-of-type(4) {
  box-shadow: 0px 0px 0px 5px rgba(0, 0, 255, 0.5);
}
.carousel_int > input:nth-of-type(5):checked ~ .carousel_int__thumbnails li:nth-of-type(5) {
  box-shadow: 0px 0px 0px 5px rgba(0, 0, 255, 0.5);
}
.carousel_int > input:nth-of-type(6):checked ~ .carousel_int__thumbnails li:nth-of-type(6) {
  box-shadow: 0px 0px 0px 5px rgba(0, 0, 255, 0.5);
}

.carousel_int__slides {
  position: relative;
  z-index: 1;
  padding: 0;
  margin: 0;
  overflow: hidden;
  white-space: nowrap;
  box-sizing: border-box;
  display: flex;
  width: 100%;
}

.carousel_int__slide {
  position: relative;
  display: block;
  flex: 1 0 100%;
  width: 100%;
  height: 100%;
  overflow: hidden;
  transition: all 300ms ease-out;
  vertical-align: top;
  box-sizing: border-box;
  white-space: normal;
}
.carousel_int__slide figure {
  display: flex;
  margin: 0;
}
.carousel_int__slide div {
  position: relative;
  width: 100%;
}
.carousel_int__slide div:before {
  display: block;
  content: "";
  width: 100%;
  padding-top: 66.6666666667%;
}
.carousel_int__slide div > img {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
}
.carousel_int__slide img {
  display: block;
  flex: 1 1 auto;
  object-fit: cover;
}
.carousel_int__slide .credit {
  margin-top: 1rem;
  color: rgba(0, 0, 0, 0.5);
  display: block;
}
.carousel_int__slide.scrollable {
  overflow-y: scroll;
}

.carousel_int__thumbnails {
  list-style: none;
  padding: 0;
  margin: 0;
}
.carousel_int__slides + .carousel_int__thumbnails {
  margin-top: 10px;
}
.carousel_int__thumbnails li {
  flex: 1 1 auto;
  width: 95%;
  transition: all 300ms ease-in-out;
  border-bottom: solid 2px ;
  margin-top: 5px;
  padding-bottom: 3px;
  border-bottom-color: rgba(1, 1, 1, 0.3);
  font-size: 13px;
  
}
.top-25{
  top: 25;
}
.spBtn_1{
  width: 45%;
}
.spBtn{
  width: 45%;
  font-size: 14px;
}
.carousel_title div{
  text-align: left;
  display: flex;
  justify-content: center;
  align-items: center;
  padding-left: 8px;
 
}
.carousel_int__thumbnails label {
  display: block;
  position: relative;
  width:95%;
}
.carousel_int__thumbnails label:focus {
  display: block;
  content: "";
  width: 100%;
  color: #0057b7;
}
.carousel_int__thumbnails label:hover, .carousel_int__thumbnails label:focus {
  cursor: pointer;
}
.carousel_int__thumbnails label:hover img, .carousel_int__thumbnails label:focus img {
  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.25);
  transition: all 300ms ease-in-out;
}
.carousel_int__thumbnails img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
<style>

/*------------dropdown---------------------------*/
.dropdown-menu>li
{	position:relative;
	-webkit-user-select: none; /* Chrome/Safari */        
	-moz-user-select: none; /* Firefox */
	-ms-user-select: none; /* IE10+ */
	/* Rules below not implemented in browsers yet */
	-o-user-select: none;
	user-select: none;
	cursor:pointer;
  z-index: 500;
}
.dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    display:none;
    margin-top: -1px;
	border-top-left-radius:0;
	border-bottom-left-radius:0;
	border-left-color:#fff;
	box-shadow:none;
}
.right-caret:after
 {	content:"";
    border-bottom: 4px solid transparent;
    border-top: 4px solid transparent;
    border-left: 4px solid orange;
    display: inline-block;
    height: 0;
    opacity: 0.8;
    vertical-align: middle;
    width: 0;
	margin-left:5px;
}
.left-caret:after
{	content:"";
    border-bottom: 4px solid transparent;
    border-top: 4px solid transparent;
    border-right: 4px solid orange;
    display: inline-block;
    height: 0;
    opacity: 0.8;
    vertical-align: middle;
    width: 0;
	margin-left:5px;
}
</style>
<!----------FOOTER CSS---------------->
<style>
  
footer {
  padding: 5em 0; }

.footer-02 {
  background: #002b3e; }
  .footer-02 .footer-heading {
    font-size: 19px;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 10px; }
    .footer-02 .footer-heading-2 {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 20px; }
    .footer-02 .footer-heading .logo {
      color: #fff;
      text-transform: uppercase; }
  .footer-02 a {
    color: #bba387;
  text-decoration: none;
  }
  .footer-02 p {
    color: rgba(255, 255, 255, 0.3); }
  .footer-02 .copyright {
    color: rgba(255, 255, 255, 0.4);
    font-size: 14px; }
  .footer-02 .list-unstyled li a {
    color: rgba(255, 255, 255, 0.7); }
    .footer-02 .list-unstyled li a:hover {
      color: #fff; }
  .footer-02 .list-unstyled a {
    color: rgba(255, 255, 255, 0.4); }
    .footer-02 .list-unstyled a:hover {
      color: #fff; }

  .footer-02 .partner-wrap {
    border-top: 3px solid rgba(255, 255, 255, 0.1);
   
    padding: 1em 0; }
    .footer-02 .partner-wrap h3 {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.4); }
      
    .footer-02 .partner-wrap .partner-name a {
      margin-right: 10px;
      font-size: 12px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.9); }
      .partner-wrap li{
        color:#FFFFFF!important;
        font-size: 14.5px;
        line-height: 0.9;
      }
      .footNews p{
        color:#ffcc00;
        font-size: 14.5px;
      }
      .footNews h2{
        color:#ffcc00!important;
      }
      .footer-02 .partner-wrap .partner-name a span {
        color: white; }
    .footer-02 .partner-wrap .btn-custom {
      font-size: 14px; }
  .footer-02 .border-left {
    border-color: rgba(255, 255, 255, 0.05) !important; }
    @media (max-width: 1199.98px) {
      .footer-02 .border-left {
        border: none; } }
</style>















<style>
.headlinesTitle{
  font-size: 20px;
  text-align: center;
  font-weight: 700;
  padding: 0 15px 0 15px;
}
#mixedSlider {
  position: relative;
  display: flex;
  justify-content: center;
  margin-top: -30px;
}
#mixedSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
 
  margin-top: 30px;
  margin-bottom: -10px;
}
#mixedSlider .MS-content .item {
  display: inline-block;
  width: 100%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
}



#mixedSlider .MS-content .item  img {
  height: 120px;
  width: 100%;
}
#mixedSlider .MS-content .item p {
  font-size: 16px;
  margin: 2px 10px 0 5px;
  text-indent: 15px;
}
#mixedSlider .MS-content .item a {
  float: right;
  margin: 0 20px 0 0;
  font-size: 16px;
  color: rgba(0, 0, 0, 0.9);
  font-weight: bold;
  letter-spacing: 1px;
  transition: linear 0.1s;
}
#mixedSlider .MS-content .item a:hover {
  text-shadow: 0 0 1px grey;
}
#mixedSlider .MS-controls button {
  position: absolute;
  border: none;
  background-color: transparent;
  outline: 0;
  font-size: 30px;
  top: 210px;
  color: rgba(255, 255, 255, 0.7);
  transition: 0.15s linear;
}
#mixedSlider .MS-controls button:hover {
  color: rgba(0, 0, 0, 0.8);
}
@media (max-width: 992px) {
  #mixedSlider .MS-controls button {
    font-size: 30px;
  }
}

#mixedSlider .MS-controls .MS-left {
  left: 0px;
}

#mixedSlider .MS-controls .MS-right {
  right: 0px;
}

#basicSlider { position: relative; }

#basicSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 2%;
  height: 50px;
}

#basicSlider .MS-content .item {
  display: inline-block;
  width: 20%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  line-height: 50px;
  vertical-align: middle;
}
@media (max-width: 991px) {

#basicSlider .MS-content .item { width: 25%; }
}
@media (max-width: 767px) {

#basicSlider .MS-content .item { width: 35%; }
}
@media (max-width: 500px) {

#basicSlider .MS-content .item { width: 50%; }
}

#basicSlider .MS-content .item a {
  line-height: 50px;
  vertical-align: middle;
}

#basicSlider .MS-controls button { position: absolute; }

#basicSlider .MS-controls .MS-left {
  top: 35px;
  left: 10px;
}

#basicSlider .MS-controls .MS-right {
  top: 35px;
  right: 10px;
}
</style>
<?php
include 'includes/phone_header.php';
?>
    <!---news cards cdn--->

    <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js'></script>
</head>