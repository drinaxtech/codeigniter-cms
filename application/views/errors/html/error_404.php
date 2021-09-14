<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8">
<title><?=config_item('pageTitle');?> - 404 page not found</title>
<style>
body {
  margin: 0;
  font-size: 20px;
}

* {
  box-sizing: border-box;
}

.container {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background: white;
  color: black;
  font-family: arial, sans-serif;
  overflow: hidden;
}

.content {
  position: relative;
  width: 600px;
  max-width: 100%;
  margin: 20px;
  background: white;
  padding: 60px 40px;
  text-align: center;
  box-shadow: -10px 10px 67px -12px rgba(0, 0, 0, 0.2);
  opacity: 0;
  animation: apparition 0.8s 1.2s cubic-bezier(0.39, 0.575, 0.28, 0.995) forwards;
}
.content p {
  font-size: 1.3rem;
  margin-top: 0;
  margin-bottom: 0.6rem;
  letter-spacing: 0.1rem;
  color: #595959;
}
.content p:last-child {
  margin-bottom: 0;
}
.content button {
  display: inline-block;
  margin-top: 2rem;
  padding: 0.5rem 1rem;
  border: 3px solid #595959;
  background: transparent;
  font-size: 1rem;
  color: #595959;
  text-decoration: none;
  cursor: pointer;
  font-weight: bold;
}

.particle {
  position: absolute;
  display: block;
  pointer-events: none;
}
.particle:nth-child(1) {
  top: 45.3760789149%;
  left: 12.8585558853%;
  font-size: 11px;
  filter: blur(0.02px);
  animation: 28s floatReverse infinite;
}
.particle:nth-child(2) {
  top: 65.7799274486%;
  left: 68.1596884129%;
  font-size: 27px;
  filter: blur(0.04px);
  animation: 28s float infinite;
}
.particle:nth-child(3) {
  top: 56.862745098%;
  left: 49.2125984252%;
  font-size: 16px;
  filter: blur(0.06px);
  animation: 27s float infinite;
}
.particle:nth-child(4) {
  top: 47.1744471744%;
  left: 22.6824457594%;
  font-size: 14px;
  filter: blur(0.08px);
  animation: 21s float infinite;
}
.particle:nth-child(5) {
  top: 69.5226438188%;
  left: 92.4287118977%;
  font-size: 17px;
  filter: blur(0.1px);
  animation: 21s float2 infinite;
}
.particle:nth-child(6) {
  top: 60.7843137255%;
  left: 67.9133858268%;
  font-size: 16px;
  filter: blur(0.12px);
  animation: 30s floatReverse infinite;
}
.particle:nth-child(7) {
  top: 96%;
  left: 51.7073170732%;
  font-size: 25px;
  filter: blur(0.14px);
  animation: 24s floatReverse2 infinite;
}
.particle:nth-child(8) {
  top: 59.1133004926%;
  left: 58.3003952569%;
  font-size: 12px;
  filter: blur(0.16px);
  animation: 26s float2 infinite;
}
.particle:nth-child(9) {
  top: 32.3133414933%;
  left: 16.7158308751%;
  font-size: 17px;
  filter: blur(0.18px);
  animation: 35s floatReverse2 infinite;
}
.particle:nth-child(10) {
  top: 28.1212121212%;
  left: 61.4634146341%;
  font-size: 25px;
  filter: blur(0.2px);
  animation: 24s floatReverse infinite;
}
.particle:nth-child(11) {
  top: 41.7475728155%;
  left: 7.8125%;
  font-size: 24px;
  filter: blur(0.22px);
  animation: 21s float2 infinite;
}
.particle:nth-child(12) {
  top: 94.6979038224%;
  left: 75.1730959446%;
  font-size: 11px;
  filter: blur(0.24px);
  animation: 22s floatReverse infinite;
}
.particle:nth-child(13) {
  top: 21.4111922141%;
  left: 35.2250489237%;
  font-size: 22px;
  filter: blur(0.26px);
  animation: 31s floatReverse2 infinite;
}
.particle:nth-child(14) {
  top: 55.7457212714%;
  left: 14.7347740668%;
  font-size: 18px;
  filter: blur(0.28px);
  animation: 28s floatReverse2 infinite;
}
.particle:nth-child(15) {
  top: 60.7228915663%;
  left: 14.5631067961%;
  font-size: 30px;
  filter: blur(0.3px);
  animation: 37s floatReverse2 infinite;
}
.particle:nth-child(16) {
  top: 18.313253012%;
  left: 6.7961165049%;
  font-size: 30px;
  filter: blur(0.32px);
  animation: 21s floatReverse infinite;
}
.particle:nth-child(17) {
  top: 26.9879518072%;
  left: 34.9514563107%;
  font-size: 30px;
  filter: blur(0.34px);
  animation: 28s floatReverse infinite;
}
.particle:nth-child(18) {
  top: 84.4171779141%;
  left: 18.7192118227%;
  font-size: 15px;
  filter: blur(0.36px);
  animation: 35s float infinite;
}
.particle:nth-child(19) {
  top: 90.8424908425%;
  left: 41.2168792934%;
  font-size: 19px;
  filter: blur(0.38px);
  animation: 34s floatReverse2 infinite;
}
.particle:nth-child(20) {
  top: 17.6687116564%;
  left: 57.1428571429%;
  font-size: 15px;
  filter: blur(0.4px);
  animation: 40s float2 infinite;
}
.particle:nth-child(21) {
  top: 86.851628468%;
  left: 30.1263362488%;
  font-size: 29px;
  filter: blur(0.42px);
  animation: 31s float infinite;
}
.particle:nth-child(22) {
  top: 76.0975609756%;
  left: 94.1176470588%;
  font-size: 20px;
  filter: blur(0.44px);
  animation: 34s floatReverse infinite;
}
.particle:nth-child(23) {
  top: 25.1511487304%;
  left: 47.711781889%;
  font-size: 27px;
  filter: blur(0.46px);
  animation: 22s floatReverse2 infinite;
}
.particle:nth-child(24) {
  top: 48.5436893204%;
  left: 88.8671875%;
  font-size: 24px;
  filter: blur(0.48px);
  animation: 37s floatReverse infinite;
}
.particle:nth-child(25) {
  top: 9.7323600973%;
  left: 6.8493150685%;
  font-size: 22px;
  filter: blur(0.5px);
  animation: 37s float infinite;
}
.particle:nth-child(26) {
  top: 76.5644171779%;
  left: 14.7783251232%;
  font-size: 15px;
  filter: blur(0.52px);
  animation: 27s floatReverse2 infinite;
}
.particle:nth-child(27) {
  top: 22.5766871166%;
  left: 57.1428571429%;
  font-size: 15px;
  filter: blur(0.54px);
  animation: 34s float infinite;
}
.particle:nth-child(28) {
  top: 60.1212121212%;
  left: 69.2682926829%;
  font-size: 25px;
  filter: blur(0.56px);
  animation: 31s float infinite;
}
.particle:nth-child(29) {
  top: 14.4927536232%;
  left: 29.1828793774%;
  font-size: 28px;
  filter: blur(0.58px);
  animation: 31s float2 infinite;
}
.particle:nth-child(30) {
  top: 93.7114673243%;
  left: 18.7932739862%;
  font-size: 11px;
  filter: blur(0.6px);
  animation: 31s floatReverse2 infinite;
}
.particle:nth-child(31) {
  top: 34.5252774353%;
  left: 40.5539070227%;
  font-size: 11px;
  filter: blur(0.62px);
  animation: 29s floatReverse2 infinite;
}
.particle:nth-child(32) {
  top: 8.7804878049%;
  left: 36.2745098039%;
  font-size: 20px;
  filter: blur(0.64px);
  animation: 35s floatReverse2 infinite;
}
.particle:nth-child(33) {
  top: 89.646772229%;
  left: 95.0048971596%;
  font-size: 21px;
  filter: blur(0.66px);
  animation: 31s floatReverse infinite;
}
.particle:nth-child(34) {
  top: 94.8004836759%;
  left: 96.3972736125%;
  font-size: 27px;
  filter: blur(0.68px);
  animation: 22s float2 infinite;
}
.particle:nth-child(35) {
  top: 38.6007237636%;
  left: 79.6890184645%;
  font-size: 29px;
  filter: blur(0.7px);
  animation: 27s float infinite;
}
.particle:nth-child(36) {
  top: 66.9126691267%;
  left: 13.8203356367%;
  font-size: 13px;
  filter: blur(0.72px);
  animation: 39s float infinite;
}
.particle:nth-child(37) {
  top: 88.8888888889%;
  left: 48.0863591757%;
  font-size: 19px;
  filter: blur(0.74px);
  animation: 21s float2 infinite;
}
.particle:nth-child(38) {
  top: 76.6584766585%;
  left: 91.7159763314%;
  font-size: 14px;
  filter: blur(0.76px);
  animation: 37s floatReverse infinite;
}
.particle:nth-child(39) {
  top: 27.2838002436%;
  left: 95.9843290891%;
  font-size: 21px;
  filter: blur(0.78px);
  animation: 35s floatReverse2 infinite;
}
.particle:nth-child(40) {
  top: 19.6078431373%;
  left: 1.968503937%;
  font-size: 16px;
  filter: blur(0.8px);
  animation: 34s float2 infinite;
}
.particle:nth-child(41) {
  top: 65.2068126521%;
  left: 72.4070450098%;
  font-size: 22px;
  filter: blur(0.82px);
  animation: 24s float2 infinite;
}
.particle:nth-child(42) {
  top: 34.398034398%;
  left: 72.9783037475%;
  font-size: 14px;
  filter: blur(0.84px);
  animation: 21s floatReverse2 infinite;
}
.particle:nth-child(43) {
  top: 31.884057971%;
  left: 64.2023346304%;
  font-size: 28px;
  filter: blur(0.86px);
  animation: 38s floatReverse infinite;
}
.particle:nth-child(44) {
  top: 26.6009852217%;
  left: 32.6086956522%;
  font-size: 12px;
  filter: blur(0.88px);
  animation: 22s floatReverse2 infinite;
}
.particle:nth-child(45) {
  top: 11.6363636364%;
  left: 6.8292682927%;
  font-size: 25px;
  filter: blur(0.9px);
  animation: 37s floatReverse infinite;
}
.particle:nth-child(46) {
  top: 19.6319018405%;
  left: 53.2019704433%;
  font-size: 15px;
  filter: blur(0.92px);
  animation: 26s floatReverse infinite;
}
.particle:nth-child(47) {
  top: 87.2727272727%;
  left: 75.1219512195%;
  font-size: 25px;
  filter: blur(0.94px);
  animation: 25s floatReverse infinite;
}
.particle:nth-child(48) {
  top: 32.0388349515%;
  left: 21.484375%;
  font-size: 24px;
  filter: blur(0.96px);
  animation: 40s float infinite;
}
.particle:nth-child(49) {
  top: 39.9512789281%;
  left: 58.7659157689%;
  font-size: 21px;
  filter: blur(0.98px);
  animation: 29s floatReverse2 infinite;
}
.particle:nth-child(50) {
  top: 84.8780487805%;
  left: 43.137254902%;
  font-size: 20px;
  filter: blur(1px);
  animation: 29s float2 infinite;
}
.particle:nth-child(51) {
  top: 57.3511543135%;
  left: 10.752688172%;
  font-size: 23px;
  filter: blur(1.02px);
  animation: 27s floatReverse2 infinite;
}
.particle:nth-child(52) {
  top: 42.7184466019%;
  left: 33.203125%;
  font-size: 24px;
  filter: blur(1.04px);
  animation: 28s floatReverse2 infinite;
}
.particle:nth-child(53) {
  top: 27.3838630807%;
  left: 75.6385068762%;
  font-size: 18px;
  filter: blur(1.06px);
  animation: 26s floatReverse infinite;
}
.particle:nth-child(54) {
  top: 11.6222760291%;
  left: 70.1754385965%;
  font-size: 26px;
  filter: blur(1.08px);
  animation: 21s float infinite;
}
.particle:nth-child(55) {
  top: 96.5517241379%;
  left: 3.95256917%;
  font-size: 12px;
  filter: blur(1.1px);
  animation: 40s float2 infinite;
}
.particle:nth-child(56) {
  top: 80.5896805897%;
  left: 35.5029585799%;
  font-size: 14px;
  filter: blur(1.12px);
  animation: 37s floatReverse infinite;
}
.particle:nth-child(57) {
  top: 32.2344322344%;
  left: 24.5338567223%;
  font-size: 19px;
  filter: blur(1.14px);
  animation: 33s float2 infinite;
}
.particle:nth-child(58) {
  top: 84.4660194175%;
  left: 6.8359375%;
  font-size: 24px;
  filter: blur(1.16px);
  animation: 33s float infinite;
}
.particle:nth-child(59) {
  top: 34.8246674728%;
  left: 18.5004868549%;
  font-size: 27px;
  filter: blur(1.18px);
  animation: 25s floatReverse2 infinite;
}
.particle:nth-child(60) {
  top: 94.9152542373%;
  left: 28.2651072125%;
  font-size: 26px;
  filter: blur(1.2px);
  animation: 32s float infinite;
}
.particle:nth-child(61) {
  top: 53.7240537241%;
  left: 34.3473994112%;
  font-size: 19px;
  filter: blur(1.22px);
  animation: 29s floatReverse infinite;
}
.particle:nth-child(62) {
  top: 56.7237163814%;
  left: 36.3457760314%;
  font-size: 18px;
  filter: blur(1.24px);
  animation: 25s float infinite;
}
.particle:nth-child(63) {
  top: 30.3549571603%;
  left: 50.1474926254%;
  font-size: 17px;
  filter: blur(1.26px);
  animation: 27s floatReverse infinite;
}
.particle:nth-child(64) {
  top: 59.6577017115%;
  left: 24.557956778%;
  font-size: 18px;
  filter: blur(1.28px);
  animation: 38s float2 infinite;
}
.particle:nth-child(65) {
  top: 37.4845869297%;
  left: 48.4668644906%;
  font-size: 11px;
  filter: blur(1.3px);
  animation: 22s float infinite;
}
.particle:nth-child(66) {
  top: 88.2424242424%;
  left: 68.2926829268%;
  font-size: 25px;
  filter: blur(1.32px);
  animation: 30s float infinite;
}
.particle:nth-child(67) {
  top: 62.7261761158%;
  left: 19.436345967%;
  font-size: 29px;
  filter: blur(1.34px);
  animation: 38s float2 infinite;
}
.particle:nth-child(68) {
  top: 50.2463054187%;
  left: 96.837944664%;
  font-size: 12px;
  filter: blur(1.36px);
  animation: 33s floatReverse infinite;
}
.particle:nth-child(69) {
  top: 33.8983050847%;
  left: 2.9239766082%;
  font-size: 26px;
  filter: blur(1.38px);
  animation: 39s float2 infinite;
}
.particle:nth-child(70) {
  top: 34.6987951807%;
  left: 53.3980582524%;
  font-size: 30px;
  filter: blur(1.4px);
  animation: 31s float infinite;
}
.particle:nth-child(71) {
  top: 22.3844282238%;
  left: 93.9334637965%;
  font-size: 22px;
  filter: blur(1.42px);
  animation: 26s floatReverse infinite;
}
.particle:nth-child(72) {
  top: 90.6211936663%;
  left: 6.8560235064%;
  font-size: 21px;
  filter: blur(1.44px);
  animation: 23s float2 infinite;
}
.particle:nth-child(73) {
  top: 24.1254523522%;
  left: 53.4499514091%;
  font-size: 29px;
  filter: blur(1.46px);
  animation: 30s floatReverse infinite;
}
.particle:nth-child(74) {
  top: 53.7240537241%;
  left: 9.8135426889%;
  font-size: 19px;
  filter: blur(1.48px);
  animation: 23s floatReverse infinite;
}
.particle:nth-child(75) {
  top: 23.2164449819%;
  left: 1.9474196689%;
  font-size: 27px;
  filter: blur(1.5px);
  animation: 23s floatReverse infinite;
}
.particle:nth-child(76) {
  top: 77.5757575758%;
  left: 47.8048780488%;
  font-size: 25px;
  filter: blur(1.52px);
  animation: 36s floatReverse infinite;
}
.particle:nth-child(77) {
  top: 52.3636363636%;
  left: 39.0243902439%;
  font-size: 25px;
  filter: blur(1.54px);
  animation: 38s float infinite;
}
.particle:nth-child(78) {
  top: 96.0784313725%;
  left: 78.7401574803%;
  font-size: 16px;
  filter: blur(1.56px);
  animation: 23s floatReverse2 infinite;
}
.particle:nth-child(79) {
  top: 18.401937046%;
  left: 31.1890838207%;
  font-size: 26px;
  filter: blur(1.58px);
  animation: 39s float2 infinite;
}
.particle:nth-child(80) {
  top: 50.5467800729%;
  left: 68.4261974585%;
  font-size: 23px;
  filter: blur(1.6px);
  animation: 37s float2 infinite;
}

@keyframes apparition {
  from {
    opacity: 0;
    transform: translateY(100px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
@keyframes float {
  0%,100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(180px);
  }
}
@keyframes floatReverse {
  0%,100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-180px);
  }
}
@keyframes float2 {
  0%,100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(28px);
  }
}
@keyframes floatReverse2 {
  0%,100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-28px);
  }
}
</style>
<script>
  window.console = window.console || function(t) {};
</script>
<script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
</head>
<body translate="no">
<main class="container">
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">4</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<span class="particle">0</span>
<article class="content">
<p>Damnit stranger,</p>
<p>You got lost in the <strong>404</strong> galaxy.</p>
<p>
<button onClick="window.location.href ='<?= config_item('base_url'); ?>'">Go back to home.</button>
</p>
</article>
</main>

<script id="rendered-js">
// Nope
//# sourceURL=pen.js
    </script>


</body></html>