<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/><meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Wilyonaryo</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
tailwind.config={
  theme:{extend:{
    animation:{float:'float 6s ease-in-out infinite','pulse-slow':'pulse 3s cubic-bezier(0.4,0,0.6,1) infinite','spin-slow':'spin 20s linear infinite',glow:'glow 2s ease-in-out infinite alternate'},
    keyframes:{
      float:{'0%,100%':{transform:'translateY(0) rotate(-2deg)'},'50%':{transform:'translateY(-20px) rotate(2deg)'}},
      glow:{'0%':{boxShadow:'0 0 5px rgba(124,58,237,.5)'},'100%':{boxShadow:'0 0 20px rgba(124,58,237,.8),0 0 30px rgba(124,58,237,.6)'}}
    }
  }}
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{font-family:Poppins,sans-serif;box-sizing:border-box}
body{background:url('https://i.ibb.co/p62f5Ws3/bagong-box2.png') center/cover no-repeat fixed;overflow-x:hidden}
@keyframes gradientBG{0%{background-position:0 50%}50%{background-position:100% 50%}100%{background-position:0 50%}}
.perspective{perspective:1200px}
.box-container{width:80px;height:80px;position:relative;transform-style:preserve-3d;transition:transform .7s cubic-bezier(.2,.9,.2,1);margin:0 auto}
.box-face{position:absolute;inset:0;backface-visibility:hidden;border-radius:10px;overflow:hidden;display:flex;align-items:center;justify-content:center;-webkit-backface-visibility:hidden}
.box-front{transform:rotateY(0)}
.box-back{transform:rotateY(180deg)}
.box-container.flipped{transform:rotateY(180deg)}
.box-face img{width:100%;height:100%;object-fit:contain;display:block;pointer-events:none;user-select:none}
.box-back span{opacity:0;transform:translateY(10px);transition:all .3s ease .3s}
.box-container.flipped .box-back span{opacity:1;transform:translateY(0)}
.front-overlay{display:none}
@media (max-width:640px){.box-container{width:60px;height:60px}.letter-overlay{font-size:1.4rem}}
.letter-btn{transition:.3s;border-radius:12px;font-weight:600;text-shadow:0 1px 2px rgba(0,0,0,.3)}
.letter-btn:hover{transform:translateY(-3px);box-shadow:0 5px 15px rgba(0,0,0,.3)}
.letter-btn:disabled{opacity:.6;transform:scale(.95)}
.floating{animation:float 6s ease-in-out infinite}.glow-effect{animation:glow 2s ease-in-out infinite alternate}
.confetti-canvas{position:fixed;inset:0;width:100%;height:100%;pointer-events:none;z-index:100}
.stars,.twinkling{position:fixed;inset:0;width:100%;height:100%;z-index:-1}
.stars{background-image:radial-gradient(2px 2px at 20px 30px,#eee,transparent),radial-gradient(2px 2px at 40px 70px,rgba(255,255,255,.8),transparent),radial-gradient(1px 1px at 90px 40px,#fff,transparent),radial-gradient(2px 2px at 130px 80px,rgba(255,255,255,.6),transparent),radial-gradient(1px 1px at 160px 30px,#fff,transparent);background-repeat:repeat;background-size:200px 200px;opacity:.7}
.twinkling{background-image:radial-gradient(rgba(255,255,255,.8) 0%,transparent 2px),radial-gradient(rgba(255,255,255,.8) 0%,transparent 2px),radial-gradient(rgba(255,255,255,.8) 0%,transparent 2px);background-size:100px 100px;background-position:0 0,50px 50px,100px 100px;opacity:.3;animation:twinkling 4s infinite}
@keyframes twinkling{0%{opacity:.3}50%{opacity:.6}100%{opacity:.3}}
.nav-button{transition:.3s}.nav-button:hover{transform:translateY(-5px) scale(1.1)}
.card-hover{transition:all .4s cubic-bezier(.175,.885,.32,1.275)}
.card-hover:hover{transform:translateY(-10px) scale(1.02);box-shadow:0 20px 40px rgba(0,0,0,.4)}
.color-btn{transition:.3s;border-radius:12px;font-weight:600;text-shadow:0 1px 2px rgba(0,0,0,.3)}
.color-btn:hover{transform:translateY(-3px);box-shadow:0 5px 15px rgba(0,0,0,.3)}
.color-btn.selected{transform:scale(1.05);box-shadow:0 0 15px rgba(255,255,255,.8);border:2px solid #fff}
.balance-display{background:linear-gradient(135deg,#1a2a6c,#f37005,#1a2a6c);background-size:400% 400%;animation:gradientBG 3s ease infinite;border-radius:16px;padding:16px;text-align:center;font-weight:700;font-size:1.4rem;color:#fff;text-shadow:0 2px 4px rgba(0,0,0,.5)}
.header-glow{position:relative}
.header-glow::after{content:'';position:absolute;inset:-2px;background:linear-gradient(45deg,#8b5cf6,#ec4899,#3b82f6);z-index:-1;border-radius:16px;filter:blur(10px);opacity:.7}
.logo-container{position:relative;display:inline-block}
.logo-glow{position:absolute;top:-20px;left:-20px;width:calc(100% + 40px);height:calc(100% + 40px);background:radial-gradient(circle,rgba(139,92,246,.4) 0%,transparent 70%);border-radius:50%;z-index:-1;animation:pulse-slow 3s infinite}
</style>
</head>
<body class="min-h-screen flex flex-col relative overflow-x-hidden">
<div class="stars"></div><div class="twinkling"></div>
<canvas id="confettiCanvas" class="confetti-canvas"></canvas>

<div class="container mx-auto px-4 py-8 flex flex-col items-center relative z-20 min-h-[calc(100vh-150px)]">
  <!-- HEADER -->
  <div class="w-full flex justify-between items-center mb-8 p-4 bg-gradient-to-r from-indigo-900/90 to-purple-900/90 rounded-xl shadow-xl backdrop-blur-md border border-indigo-500/20 header-glow">
    <div class="flex items-center space-x-2"><i data-feather="user" class="text-indigo-300 w-6 h-6"></i><span class="text-indigo-100 font-medium text-lg">Admin</span></div>
    <div class="flex gap-4">
      <button class="flex flex-col items-center text-indigo-200 nav-button"><div class="p-2 bg-indigo-800/50 rounded-full mb-1"><i data-feather="home" class="w-5 h-5"></i></div><span class="text-xs font-medium">Dashboard</span></button>
      <button class="flex flex-col items-center text-gray-300 nav-button"><div class="p-2 bg-gray-700/50 rounded-full mb-1"><i data-feather="credit-card" class="w-5 h-5"></i></div><span class="text-xs">Loading</span></button>
      <button class="flex flex-col items-center text-gray-300 nav-button"><div class="p-2 bg-gray-700/50 rounded-full mb-1"><i data-feather="user-plus" class="w-5 h-5"></i></div><span class="text-xs">Register</span></button>
      <button class="flex flex-col items-center text-gray-300 nav-button"><div class="p-2 bg-gray-700/50 rounded-full mb-1"><i data-feather="refresh-cw" class="w-5 h-5"></i></div><span class="text-xs">Replace</span></button>
    </div>
    <button class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-6 py-2 rounded-lg transition-all hover:scale-105 shadow-lg flex items-center"><i data-feather="log-out" class="inline mr-2"></i>Logout</button>
  </div>

  <!-- MAIN GRID -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl" data-aos="fade-up">
    <!-- BARCODE -->
    <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-200 card-hover">
      <div class="flex items-center mb-4"><div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="maximize-2" class="text-indigo-600 w-5 h-5"></i></div><h2 class="text-gray-800 font-bold text-xl">Scan / Enter Barcode</h2></div>
      <input id="barcodeInput" type="text" placeholder="Enter or scan barcode" class="w-full bg-gray-50 text-gray-800 border border-gray-300 rounded-lg px-4 py-3 mb-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-base">
      <div class="flex gap-3">
        <button onclick="resetBarcode()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-3 transition-colors font-medium">Reset</button>
        <button onclick="submitBarcode()" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg py-3 transition-all font-medium shadow-lg">Submit Barcode</button>
      </div>
      <hr class="border-gray-200 my-4">
      <div class="flex items-center mb-3"><div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="user" class="text-indigo-600 w-5 h-5"></i></div><h3 class="text-gray-800 font-bold">Customer Details</h3></div>
      <ul class="text-gray-600 space-y-2">
        <li class="flex justify-between"><span class="text-gray-700">Full name:</span><span id="fullname" class="text-gray-900 font-medium">-</span></li>
        <li class="flex justify-between"><span class="text-gray-700">Username:</span><span id="username" class="text-gray-900 font-medium">-</span></li>
        <li class="flex justify-between"><span class="text-gray-700">Email:</span><span id="email" class="text-gray-900 font-medium">-</span></li>
        <li class="flex justify-between"><span class="text-gray-700">Contact:</span><span id="contact" class="text-gray-900 font-medium">-</span></li>
      </ul>
      <div class="balance-display mt-4">BALANCE: <span id="balance" class="text-yellow-300">₱0.00</span></div>
    </div>

    <!-- TICKET -->
    <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-200 card-hover">
      <div class="flex items-center mb-4"><div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="clipboard" class="text-indigo-600 w-5 h-5"></i></div><h2 class="text-gray-800 font-bold text-xl">Ticket Combination</h2></div>

      <div class="flex justify-center gap-4 mb-6 relative">
        <div id="colorBackgrounds" class="absolute -inset-4 flex justify-center gap-4 pointer-events-none"></div>
        <div id="boxesRow" class="flex justify-center gap-4 w-full"></div>
      </div>

      <div class="mb-4">
        <h3 class="text-gray-800 font-bold mb-2 text-center">Select Letters</h3>
        <div id="letters" class="grid grid-cols-7 gap-2"></div>
      </div>

      <div class="flex justify-center mb-3">
        <button onclick="playTicket()" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg py-3 px-8 transition-all font-semibold shadow-lg flex items-center gap-2"><i data-feather="play"></i>Play</button>
      </div>

      <div class="flex gap-3 justify-center">
        <button onclick="resetTicket()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-3 px-6 transition-colors font-medium">Reset</button>
        <button onclick="luckyPick()" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg py-3 px-6 transition-all font-medium shadow-lg">Lucky Pick</button>
      </div>
    </div>

    <!-- SUBSCRIPTION + HISTORY -->
    <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-200 card-hover">
      <div class="flex items-center mb-4"><div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="credit-card" class="text-indigo-600 w-5 h-5"></i></div><h2 class="text-gray-800 font-bold text-xl">Subscription</h2></div>
      <div class="space-y-3 mb-4">
        <button onclick="selectPlan('₱120 / 1 Day')" class="w-full flex justify-between items-center bg-gray-100 hover:bg-orange-500 text-gray-800 rounded-lg px-4 py-3 transition-colors font-medium"><span class="font-bold text-lg">₱120</span><span class="text-gray-600">1 Day</span></button>
        <button onclick="selectPlan('₱1,200 / 10 Days')" class="w-full flex justify-between items-center bg-gray-100 hover:bg-orange-500 text-gray-800 rounded-lg px-4 py-3 transition-colors font-medium"><span class="font-bold text-lg">₱1,200</span><span class="text-gray-600">10 Days</span></button>
        <button onclick="selectPlan('₱1,800 / 15 Days')" class="w-full flex justify-between items-center bg-gray-100 hover:bg-orange-500 text-gray-800 rounded-lg px-4 py-3 transition-colors font-medium"><span class="font-bold text-lg">₱1,800</span><span class="text-gray-600">15 Days</span></button>
        <button onclick="selectPlan('₱3,600 / 30 Days')" class="w-full flex justify-between items-center bg-gray-100 hover:bg-orange-500 text-gray-800 rounded-lg px-4 py-3 transition-colors font-medium"><span class="font-bold text-lg">₱3,600</span><span class="text-gray-600">30 Days</span></button>
      </div>
      <div class="flex gap-3 mb-3">
        <button onclick="showDetails()" class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white rounded-lg py-3 transition-all font-medium shadow-lg">Show Details</button>
        <button onclick="purchaseNow()" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg py-3 transition-all font-medium shadow-lg">Purchase Now</button>
      </div>
      <button onclick="cancelPlan()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-3 transition-colors font-medium">Cancel</button>

      <hr class="border-gray-200 my-4">
      <div class="flex items-center mb-3"><div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="clock" class="text-indigo-600 w-5 h-5"></i></div><h2 class="text-gray-800 font-bold text-lg">Ticket History</h2></div>
      <div id="ticketHistoryList" class="space-y-3 max-h-64 overflow-auto pr-2"></div>
      <div class="mt-3 text-right"><button onclick="clearHistory()" class="text-sm text-gray-600 hover:text-red-600 underline">Clear History</button></div>
    </div>
  </div>

  <!-- LOGO -->
  <div class="mt-8 md:mt-12 mb-16 md:mb-32 relative">
    <div class="absolute inset-0 bg-indigo-500/20 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute -inset-4 bg-gradient-to-r from-purple-500/20 to-indigo-500/20 rounded-full blur-lg animate-pulse opacity-70"></div>
    <img src="https://i.ibb.co/nq0TJzGq/logo.gif" alt="Wilyonaryo Logo" class="relative w-48 md:w-64 lg:w-80 h-auto drop-shadow-xl hover:drop-shadow-2xl transition-all duration-500 hover:rotate-3 z-10 floating">
    <div class="absolute -inset-8 bg-gradient-to-r from-purple-500/10 to-indigo-500/10 rounded-full blur-2xl animate-pulse opacity-30"></div>
    <div class="absolute -inset-12 bg-gradient-to-r from-pink-500/10 to-blue-500/10 rounded-full blur-3xl animate-pulse opacity-20"></div>
  </div>
</div>

<script>
AOS.init({duration:800,easing:'ease-in-out'}); feather.replace();

// Confetti
const confettiInstance=confetti.create(document.getElementById('confettiCanvas'),{resize:true,useWorker:true});
const triggerConfetti=()=>confettiInstance({particleCount:120,spread:70,origin:{y:.6}});

// Helpers
const qs=s=>document.querySelector(s), qsa=s=>document.querySelectorAll(s);
const lettersContainer=qs("#letters"), alphabet="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
alphabet.split("").forEach(ch=>{
  const b=document.createElement("button");
  b.textContent=ch;
  b.className="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-3 font-bold text-lg";
  b.onclick=()=>selectLetter(ch,b);
  lettersContainer.appendChild(b);
});

// Build 4 color bg tiles + 4 boxes
const colorBG=qs("#colorBackgrounds"), boxesRow=qs("#boxesRow");
for(let i=1;i<=4;i++){
  const bg=document.createElement('div'); bg.className="w-24 h-24 rounded-lg opacity-30 transition-all duration-500"; bg.dataset.index=i; colorBG.appendChild(bg);

  boxesRow.insertAdjacentHTML("beforeend",`
    <div id="box${i}" class="perspective">
      <div class="box-container" data-index="${i}">
        <div class="box-face box-front">
          <img src="https://i.ibb.co/LhJGrgvh/closed.jpg" alt="closed-box"><div class="front-overlay"></div>
        </div>
        <div class="box-face box-back">
          <div class="relative w-full h-full">
            <img src="https://i.ibb.co/YBN4p5bj/open.jpg" alt="open-box" class="w-full h-full">
            <span id="letter${i}" class="absolute inset-0 flex items-center justify-center text-4xl font-bold text-white" style="text-shadow:0 2px 4px rgba(0,0,0,.5)"></span>
          </div>
        </div>
      </div>
    </div>`);
}

const boxes=[qs("#box1"),qs("#box2"),qs("#box3"),qs("#box4")];
let picks=[], firstBoxOpened=false, selectedColor=null, selectedColorIndex=null;

function selectLetter(letter,btn){
  if(picks.length>=4) return;
  picks.push(letter);
  qs(`#letter${picks.length}`).textContent=letter;
  btn.disabled=true; btn.classList.remove('from-indigo-500','to-purple-600'); btn.classList.add('from-gray-500','to-gray-600');
  boxes[picks.length-1].querySelector('.box-container').classList.add('flipped');
  if(picks.length===1){ firstBoxOpened=true; triggerConfetti(); }
  if(picks.length===4) setTimeout(showColorPicker,800);
}

function resetTicket(){
  boxes.forEach((box,i)=>setTimeout(()=>{
    box.querySelector('.box-container').classList.remove('flipped');
    qs(`#letter${i+1}`).textContent="";
    const bg=qs(`#colorBackgrounds div[data-index="${i+1}"]`); bg.style.backgroundColor='transparent'; bg.style.transform='scale(1)';
  },i*100));
  picks=[]; firstBoxOpened=false;
  qsa("#letters button").forEach(b=>{b.disabled=false;b.classList.remove('from-gray-500','to-gray-600');b.classList.add('from-indigo-500','to-purple-600')});
}

function luckyPick(){
  resetTicket();
  const arr=alphabet.split("");
  for(let i=0;i<4;i++){
    setTimeout(()=>{
      const ch=arr[Math.floor(Math.random()*arr.length)];
      picks.push(ch); qs(`#letter${i+1}`).textContent=ch;
      boxes[i].querySelector('.box-container').classList.add('flipped');
      if(i===0){firstBoxOpened=true;triggerConfetti()}
      if(i===3) setTimeout(showColorPicker,1200);
    },i*300);
  }
}

const colors=[
  {name:"PULA",hex:"#FF0000"},{name:"LILA",hex:"#800080"},{name:"BERDE",hex:"#008000"},
  {name:"ASUL",hex:"#0000FF"},{name:"UBE",hex:"#9370DB"},{name:"KAHEL",hex:"#FF6600"},
  {name:"ROSAS",hex:"#FF1493"},{name:"KAYUMANGGI",hex:"#8B4513"},{name:"LANGIT",hex:"#87CEEB"},{name:"GINTO",hex:"#FFD700"},
  {name:"PILAK",hex:"#808080"},{name:"DILAW",hex:"#FFFF00"},
];

function showColorPicker(){
  const el=document.createElement('div');
  el.className='fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4';
  el.innerHTML=`
    <div class="bg-white rounded-2xl p-6 max-w-2xl w-full shadow-2xl">
      <h3 class="text-gray-800 text-2xl font-bold mb-6 text-center">Pumili ng Kulay</h3>
      <div class="grid grid-cols-3 sm:grid-cols-6 gap-3 mb-6">
        ${colors.map((c,i)=>`<button onclick="selectColor('${c.hex}',${i})" class="color-btn w-full py-4 rounded-xl font-bold text-white transition-all" style="background:${c.hex}">${c.name}</button>`).join('')}
      </div>
      <div class="flex gap-3">
        <button onclick="document.querySelector('.fixed.inset-0').remove()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-xl font-medium">Cancel</button>
        <button onclick="applyColor()" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white py-3 rounded-xl font-medium shadow-lg">Apply Color</button>
      </div>
    </div>`;
  document.body.appendChild(el);
}
function selectColor(color,idx){
  selectedColor=color; selectedColorIndex=idx;
  qsa('.color-btn').forEach(b=>b.classList.remove('selected'));
  const btn=document.querySelector(`button[onclick="selectColor('${color}', ${idx})"]`); if(btn) btn.classList.add('selected');
}
function applyColor(){
  if(!selectedColor) return alert('Please select a color');
  for(let i=1;i<=4;i++){
    qs(`#letter${i}`).style.textShadow='0 0 10px rgba(255,255,255,.8),0 0 20px currentColor';
    const bg=qs(`#colorBackgrounds div[data-index="${i}"]`); bg.style.background=selectedColor; bg.style.transform='scale(1.2)';
  }
  const m=qs('.fixed.inset-0'); if(m) m.remove(); triggerConfetti();
}

function playTicket(){
  if(picks.length!==4) return alert("Kumpletuhin muna ang 4 na letra bago mag-Play.");
  if(!selectedColor && !getAppliedColor()) return alert("Pumili at i-apply muna ang kulay bago mag-Play.");
  const letters=picks.join(""), colorHex=selectedColor||getAppliedColor(), colorName=getColorNameByHex(colorHex), when=new Date().toLocaleString('en-PH');
  const item=document.createElement("div");
  item.className="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl p-3";
  item.innerHTML=`<div class="flex items-center gap-3">
    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg font-bold bg-white border">${letters}</span>
    <div><div class="text-sm font-semibold text-gray-800">Letters: ${letters}</div><div class="text-xs text-gray-500">${when}</div></div>
  </div>
  <div class="flex items-center gap-2"><span class="text-sm font-medium text-gray-700">${colorName}</span><div class="w-6 h-6 rounded border" style="background:${colorHex}"></div></div>`;
  qs("#ticketHistoryList").prepend(item); triggerConfetti();
}

function getAppliedColor(){
  const bg=qs('#colorBackgrounds div[data-index="1"]'), c=bg?bg.style.backgroundColor:""; return c&&c!=="transparent"?rgbToHex(c):null;
}
function getColorNameByHex(hex){ if(!hex) return "N/A"; const f=colors.find(c=>c.hex.toUpperCase()===hex.toUpperCase()); return f?f.name:hex.toUpperCase() }
function rgbToHex(rgb){ const m=rgb.replace(/\s+/g,'').match(/^rgb\((\d+),(\d+),(\d+)\)$/i); if(!m) return rgb; const h=n=>('0'+parseInt(n,10).toString(16)).slice(-2); return `#${h(m[1])}${h(m[2])}${h(m[3])}`.toUpperCase() }
function clearHistory(){ qs("#ticketHistoryList").innerHTML="" }

// Barcode
function resetBarcode(){ qs("#barcodeInput").value="" }
function submitBarcode(){
  const b=qs("#barcodeInput").value;
  if(!b) return alert("Please enter a barcode");
  qs("#fullname").textContent="Kuya Will";
  qs("#username").textContent="kuyawill432";
  qs("#email").textContent="kuyawill@gmail.com";
  qs("#contact").textContent="09123456789";
  qs("#balance").textContent="₱1,200.00";
}

// Subscription
let selectedPlan=null;
function selectPlan(plan){
  selectedPlan=plan;
  qsa('.bg-gray-100').forEach(btn=>btn.classList.remove('bg-indigo-100','border-indigo-500'));
  try{event.target.classList.add('bg-indigo-100','border-indigo-500')}catch(e){}
}
function showDetails(){ selectedPlan?alert("Plan Details:\n"+selectedPlan):alert("Please select a plan first") }
function purchaseNow(){
  if(!selectedPlan) return alert("Please select a plan first");
  const m=selectedPlan.match(/₱([\d,]+)/); if(!m) return;
  const amt=+m[1].replace(/,/g,''), balEl=qs("#balance"), cur=+(balEl.textContent.replace(/[^\d.]/g,''))||0, nb=cur+amt;
  balEl.textContent=`₱${nb.toLocaleString('en-PH',{minimumFractionDigits:2,maximumFractionDigits:2})}`;
  alert(`Successfully purchased:\n${selectedPlan}\nNew Balance: ₱${nb.toLocaleString('en-PH')}`); triggerConfetti();
}
function cancelPlan(){ selectedPlan=null; qsa('.bg-gray-100').forEach(btn=>btn.classList.remove('bg-indigo-100','border-indigo-500')) }
</script>
</body>
</html>
