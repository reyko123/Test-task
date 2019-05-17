<!DOCTYPE html>
<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<style>
/*-- Base Styles --*/

html,
body {
  margin: 0;
  height: 100%;
}

html {
  font-size: 16px;
}

body {
  font-family: "Vibur", cursive;
  font-size: 1rem;
  background-image: url("https://www.dropbox.com/s/2ct0i6kc61vp0bh/wall.jpg?raw=1");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-color: #141414;
}


/*-- Sign Styles --*/

.sign {
  min-height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;


    font-size: 5.6rem;
    text-align: center;
    line-height: 1;
    color: #c6e2ff;
    animation: neon .08s ease-in-out infinite alternate;


}

/*-- Animation Keyframes --*/



@keyframes neon {
  from {
    text-shadow:
    0 0 6px rgba(202,228,225,0.92),
    0 0 30px rgba(202,228,225,0.34),
    0 0 12px rgba(30,132,242,0.52),
    0 0 21px rgba(30,132,242,0.92),
    0 0 34px rgba(30,132,242,0.78),
    0 0 54px rgba(30,132,242,0.92);
  }
  to {
    text-shadow:
    0 0 6px rgba(202,228,225,0.98),
    0 0 30px rgba(202,228,225,0.42),
    0 0 12px rgba(30,132,242,0.58),
    0 0 22px rgba(30,132,242,0.84),
    0 0 38px rgba(30,132,242,0.88),
    0 0 60px rgba(30,132,242,1);
  }
}
	</style>


</head>
<htnl>
<div class="sign">
    <span class="sign__word">no</span>
    <span class="sign__word">festival</span>
    <span class="sign__word">today</span>
</div>
</htnl>