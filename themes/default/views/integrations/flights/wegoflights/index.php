<style>
html {
    overflow-y: scroll;
}
footer {
    display : none;
}
iframe {
width: 100%;
position:fixed;
background-color: transparent;
padding: 0px;
border: 0px;
background: #fafafa;
min-height: 100%;
margin-top:-60px;
margin-bottom:1800px;
overflow-y: hidden;
}
.mob-bg {
    display:none;
}
.newsletter {
    display:none;
}

</style>
<!--<iframe src="http://phptravels.superstore.travel/en/flights/" frameborder="0" height="100%" width="100%"></iframe> -->
<iframe src="<?php echo $url; ?>" frameborder="0" height="100%" width="100%"></iframe>
