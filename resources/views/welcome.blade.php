<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Wilyonaryo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            'spin-slow': 'spin 20s linear infinite',
            'glow': 'glow 2s ease-in-out infinite alternate',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0) rotate(-2deg)' },
              '50%': { transform: 'translateY(-20px) rotate(2deg)' },
            },
            glow: {
              '0%': { boxShadow: '0 0 5px rgba(124, 58, 237, 0.5)' },
              '100%': { boxShadow: '0 0 20px rgba(124, 58, 237, 0.8), 0 0 30px rgba(124, 58, 237, 0.6)' },
            }
          }
        }
      }
    }
  </script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }

    body {
      background: url('https://i.ibb.co/p62f5Ws3/bagong-box2.png') center center / cover no-repeat fixed;
      animation: none;
      overflow-x: hidden;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .perspective { perspective: 1200px; }

    /* Box sizing & flip */
    .box-container {
      width: 80px;
      height: 80px;
      position: relative;
      transform-style: preserve-3d;
      transition: transform 0.7s cubic-bezier(0.2, 0.9, 0.2, 1);
      margin: 0 auto;
    }
.box-face {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      -webkit-backface-visibility: hidden;
    }

    /* closed face (front) */
    .box-front { transform: rotateY(0deg); }

    /* opened face (back) */
    .box-back { transform: rotateY(180deg); }

    .box-container.flipped { transform: rotateY(180deg); }

    /* images fill the face */
    .box-face img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
      pointer-events: none;
      user-select: none;
    }
    /* open box letter styling */
    .box-back span {
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s ease 0.3s;
    }
    .box-container.flipped .box-back span {
      opacity: 1;
      transform: translateY(0);
    }
/* keep front '?' hidden - we use full image as closed */
    .front-overlay { display: none; }

    /* small responsive tweaks */
    @media (max-width: 640px) {
      .box-container { width: 60px; height: 60px; }
      .letter-overlay { font-size: 1.4rem; }
    }
/* rest of original styles from your file (kept intact) */
    .letter-btn {
      transition: all 0.3s ease;
      border-radius: 12px;
      font-weight: 600;
      text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    .letter-btn:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    .letter-btn:disabled { opacity: 0.6; transform: scale(0.95); }

    .floating { animation: float 6s ease-in-out infinite; }
    .glow-effect { animation: glow 2s ease-in-out infinite alternate; }

    .confetti-canvas { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 100; }

    .stars { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-image: radial-gradient(2px 2px at 20px 30px, #eee, transparent), radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.8), transparent), radial-gradient(1px 1px at 90px 40px, #fff, transparent), radial-gradient(2px 2px at 130px 80px, rgba(255,255,255,0.6), transparent), radial-gradient(1px 1px at 160px 30px, #fff, transparent); background-repeat: repeat; background-size: 200px 200px; z-index: -1; opacity: 0.7; }
    .twinkling { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-image: radial-gradient(rgba(255,255,255,0.8) 0%, transparent 2px), radial-gradient(rgba(255,255,255,0.8) 0%, transparent 2px), radial-gradient(rgba(255,255,255,0.8) 0%, transparent 2px); background-size: 100px 100px; background-position: 0 0, 50px 50px, 100px 100px; z-index: -1; opacity: 0.3; animation: twinkling 4s infinite; }
    @keyframes twinkling { 0% { opacity: 0.3; } 50% { opacity: 0.6; } 100% { opacity: 0.3; } }

    .nav-button { transition: all 0.3s ease; }
    .nav-button:hover { transform: translateY(-5px) scale(1.1); }

    .card-hover { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .card-hover:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4); }

    .color-btn { transition: all 0.3s ease; border-radius: 12px; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3); }
    .color-btn:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    .color-btn.selected { transform: scale(1.05); box-shadow: 0 0 15px rgba(255,255,255,0.8); border: 2px solid white; }

    .balance-display { background: linear-gradient(135deg, #1a2a6c, #f37005, #1a2a6c); background-size: 400% 400%; animation: gradientBG 3s ease infinite; border-radius: 16px; padding: 16px; text-align: center; font-weight: 700; font-size: 1.4rem; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }

    .header-glow { position: relative; }
    .header-glow::after { content: ''; position: absolute; top: -2px; left: -2px; right: -2px; bottom: -2px; background: linear-gradient(45deg, #8b5cf6, #ec4899, #3b82f6); z-index: -1; border-radius: 16px; filter: blur(10px); opacity: 0.7; }

    .logo-container { position: relative; display: inline-block; }
    .logo-glow { position: absolute; top: -20px; left: -20px; width: calc(100% + 40px); height: calc(100% + 40px); background: radial-gradient(circle, rgba(139, 92, 246, 0.4) 0%, transparent 70%); border-radius: 50%; z-index: -1; animation: pulse-slow 3s infinite; }
  </style>
</head>
<body class="min-h-screen flex flex-col relative overflow-x-hidden">
  <!-- Animated Background -->
  <div class="stars"></div>
  <div class="twinkling"></div>

  <!-- Confetti Canvas -->
  <canvas id="confettiCanvas" class="confetti-canvas"></canvas>

  <!-- CONTENT -->
  <div class="container mx-auto px-4 py-8 flex flex-col items-center relative z-20 min-h-[calc(100vh-150px)]">
    <!-- HEADER -->
    <div class="w-full flex justify-between items-center mb-8 p-4 bg-gradient-to-r from-indigo-900/90 to-purple-900/90 rounded-xl shadow-xl backdrop-blur-md border border-indigo-500/20 header-glow">
      <div class="flex items-center space-x-2">
        <i data-feather="user" class="text-indigo-300 w-6 h-6"></i>
        <span class="text-indigo-100 font-medium text-lg">Admin</span>
      </div>
      <div class="flex gap-4">
        <button class="flex flex-col items-center text-indigo-200 nav-button">
          <div class="p-2 bg-indigo-800/50 rounded-full mb-1"><i data-feather="home" class="w-5 h-5"></i></div>
          <span class="text-xs font-medium">Dashboard</span>
        </button>
        <button class="flex flex-col items-center text-gray-300 nav-button">
          <div class="p-2 bg-gray-700/50 rounded-full mb-1"><i data-feather="credit-card" class="w-5 h-5"></i></div>
          <span class="text-xs">Loading</span>
        </button>
        <button class="flex flex-col items-center text-gray-300 nav-button">
          <div class="p-2 bg-gray-700/50 rounded-full mb-1"><i data-feather="user-plus" class="w-5 h-5"></i></div>
          <span class="text-xs">Register</span>
        </button>
        <button class="flex flex-col items-center text-gray-300 nav-button">
          <div class="p-2 bg-gray-700/50 rounded-full mb-1"><i data-feather="refresh-cw" class="w-5 h-5"></i></div>
          <span class="text-xs">Replace</span>
        </button>
      </div>
      <button class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-6 py-2 rounded-lg transition-all transform hover:scale-105 shadow-lg flex items-center">
        <i data-feather="log-out" class="inline mr-2"></i>Logout
      </button>
    </div>
<!-- Main Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl" data-aos="fade-up">
      <!-- BARCODE -->
      <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-200 card-hover">
        <div class="flex items-center mb-4">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3">
            <i data-feather="maximize-2" class="text-indigo-600 w-5 h-5"></i>
          </div>
          <h2 class="text-gray-800 font-bold text-xl">Scan / Enter Barcode</h2>
        </div>
        <input id="barcodeInput" type="text" placeholder="Enter or scan barcode"
               class="w-full bg-gray-50 text-gray-800 border border-gray-300 rounded-lg px-4 py-3 mb-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-base">
        <div class="flex gap-3">
          <button onclick="resetBarcode()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-3 transition-colors font-medium">Reset</button>
          <button onclick="submitBarcode()" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg py-3 transition-all font-medium shadow-lg">Submit Barcode</button>
        </div>
        <hr class="border-gray-200 my-4">
        <div class="flex items-center mb-3">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3">
            <i data-feather="user" class="text-indigo-600 w-5 h-5"></i>
          </div>
          <h3 class="text-gray-800 font-bold">Customer Details</h3>
        </div>
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
        <div class="flex items-center mb-4">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="clipboard" class="text-indigo-600 w-5 h-5"></i></div>
          <h2 class="text-gray-800 font-bold text-xl">Ticket Combination</h2>
        </div>
    <!-- BOX ROW -->
    <div class="flex justify-center gap-4 mb-6 relative">
        <div id="colorBackgrounds" class="absolute -inset-4 flex justify-center gap-4 pointer-events-none">
          <div class="w-24 h-24 rounded-lg opacity-30 transition-all duration-500" data-index="1"></div>
          <div class="w-24 h-24 rounded-lg opacity-30 transition-all duration-500" data-index="2"></div>
          <div class="w-24 h-24 rounded-lg opacity-30 transition-all duration-500" data-index="3"></div>
          <div class="w-24 h-24 rounded-lg opacity-30 transition-all duration-500" data-index="4"></div>
        </div>
<!-- Box 1 (leftmost) -->
            <!-- hello -->
          <div id="box1" class="perspective">
            <div class="box-container" data-index="1">
              <div class="box-face box-front">
                <!-- closed image -->
                <img src="https://i.ibb.co/LhJGrgvh/closed.jpg" alt="closed-box">
                <div class="front-overlay"></div>
              </div>
              <div class="box-face box-back">
                <!-- open image -->
                <div class="relative w-full h-full">
                  <img src="https://i.ibb.co/YBN4p5bj/open.jpg" alt="open-box" class="w-full h-full">
                  <span id="letter1" class="absolute inset-0 flex items-center justify-center text-4xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5)"></span>
                </div>
</div>
            </div>
          </div>

          <!-- Box 2 -->
          <div id="box2" class="perspective">
            <div class="box-container" data-index="2">
              <div class="box-face box-front">
                <img src="https://i.ibb.co/LhJGrgvh/closed.jpg" alt="closed-box">
                <div class="front-overlay"></div>
              </div>
              <div class="box-face box-back">
                <div class="relative w-full h-full">
                  <img src="https://i.ibb.co/YBN4p5bj/open.jpg" alt="open-box" class="w-full h-full">
                  <span id="letter2" class="absolute inset-0 flex items-center justify-center text-4xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5)"></span>
                </div>
</div>
            </div>
          </div>

          <!-- Box 3 -->
          <div id="box3" class="perspective">
            <div class="box-container" data-index="3">
              <div class="box-face box-front">
                <img src="https://i.ibb.co/LhJGrgvh/closed.jpg" alt="closed-box">
                <div class="front-overlay"></div>
              </div>
              <div class="box-face box-back">
                <div class="relative w-full h-full">
                  <img src="https://i.ibb.co/YBN4p5bj/open.jpg" alt="open-box" class="w-full h-full">
                  <span id="letter3" class="absolute inset-0 flex items-center justify-center text-4xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5)"></span>
                </div>
</div>
            </div>
          </div>

          <!-- Box 4 -->
          <div id="box4" class="perspective">
            <div class="box-container" data-index="4">
              <div class="box-face box-front">
                <img src="https://i.ibb.co/LhJGrgvh/closed.jpg" alt="closed-box">
                <div class="front-overlay"></div>
              </div>
              <div class="box-face box-back">
                <div class="relative w-full h-full">
                  <img src="https://i.ibb.co/YBN4p5bj/open.jpg" alt="open-box" class="w-full h-full">
                  <span id="letter4" class="absolute inset-0 flex items-center justify-center text-4xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5)"></span>
                </div>
</div>
            </div>
          </div>
        </div>

        <!-- letters grid -->
        <div class="mb-4">
          <h3 class="text-gray-800 font-bold mb-2 text-center">Select Letters</h3>
          <div id="letters" class="grid grid-cols-7 gap-2"></div>
        </div>

        <!-- PLAY BUTTON (above Reset & Lucky Pick) -->
        <div class="flex justify-center mb-3">
          <button onclick="playTicket()" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg py-3 px-8 transition-all font-semibold shadow-lg flex items-center gap-2">
            <i data-feather="play"></i>
            Play
          </button>
        </div>

        <div class="flex gap-3 justify-center">
          <button onclick="resetTicket()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-3 px-6 transition-colors font-medium">Reset</button>
          <button onclick="luckyPick()" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg py-3 px-6 transition-all font-medium shadow-lg">Lucky Pick</button>
        </div>
      </div>

      <!-- SUBSCRIPTION (now contains Ticket History at the bottom) -->
      <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-200 card-hover">
        <div class="flex items-center mb-4">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="credit-card" class="text-indigo-600 w-5 h-5"></i></div>
          <h2 class="text-gray-800 font-bold text-xl">Subscription</h2>
        </div>
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

        <!-- Ticket History placed below Cancel -->
        <hr class="border-gray-200 my-4">
        <div class="flex items-center mb-3">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="clock" class="text-indigo-600 w-5 h-5"></i></div>
          <h2 class="text-gray-800 font-bold text-lg">Ticket History</h2>
        </div>
        <div id="ticketHistoryList" class="space-y-3 max-h-64 overflow-auto pr-2">
          <!-- history items appear here -->
        </div>
        <div class="mt-3 text-right">
          <button onclick="clearHistory()" class="text-sm text-gray-600 hover:text-red-600 underline">Clear History</button>
        </div>
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
    // Initialize AOS & icons
    AOS.init({ duration: 800, easing: 'ease-in-out' });
    feather.replace();

    // Confetti
    const canvas = document.getElementById('confettiCanvas');
    const confettiInstance = confetti.create(canvas, { resize: true, useWorker: true });
    function triggerConfetti() {
      confettiInstance({ particleCount: 120, spread: 70, origin: { y: 0.6 } });
    }

    // Letters grid
    const lettersContainer = document.getElementById("letters");
    const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    alphabet.split("").forEach(letter => {
      const btn = document.createElement("button");
      btn.textContent = letter;
      btn.className = "letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-3 font-bold text-lg";
      btn.onclick = () => selectLetter(letter, btn);
      lettersContainer.appendChild(btn);
    });

    // Boxes and state
    const boxes = [
      document.getElementById("box1"),
      document.getElementById("box2"),
      document.getElementById("box3"),
      document.getElementById("box4")
    ];
    let picks = []; // store picked letters in order
    let firstBoxOpened = false;
    function selectLetter(letter, btn) {
      // add to picks (up to 4)
      if (picks.length >= 4) return;
      picks.push(letter);

      // Get current pick index (0..3)
      const currentIndex = picks.length - 1;
      const span = document.getElementById(`letter${currentIndex + 1}`);
      span.textContent = letter;
      // Disable the chosen button
      btn.disabled = true;
      btn.classList.remove('bg-gradient-to-br', 'from-indigo-500', 'to-purple-600');
      btn.classList.add('bg-gradient-to-br', 'from-gray-500', 'to-gray-600');
// Open the corresponding box for this pick
      const boxContainer = boxes[currentIndex].querySelector('.box-container');
      boxContainer.classList.add('flipped');
      
      // Small celebration on first pick
      if (currentIndex === 0) {
        firstBoxOpened = true;
        triggerConfetti();
      }

      // if all 4 picked, show color picker after short delay
      if (picks.length === 4) {
        setTimeout(() => showColorPicker(), 800);
      }
    }
    function resetTicket() {
      // close all boxes visually in reverse order with delay
      boxes.forEach((box, index) => {
        setTimeout(() => {
          const boxContainer = box.querySelector('.box-container');
          boxContainer.classList.remove('flipped');
          const span = document.getElementById(`letter${index + 1}`);
          span.textContent = "";
          
          // Reset background color
          const bg = document.querySelector(`#colorBackgrounds div[data-index="${index + 1}"]`);
          bg.style.backgroundColor = 'transparent';
          bg.style.transform = 'scale(1)';
        }, index * 100);
      });
      picks = [];
      firstBoxOpened = false;
      document.querySelectorAll("#letters button").forEach(b => {
        b.disabled = false;
        b.classList.remove('bg-gradient-to-br', 'from-gray-500', 'to-gray-600');
        b.classList.add('bg-gradient-to-br', 'from-indigo-500', 'to-purple-600');
      });
    }
function luckyPick() {
      resetTicket();
      const letters = alphabet.split("");
      // choose 4 random letters and open boxes sequentially
      for (let i = 0; i < 4; i++) {
        setTimeout(() => {
          const rand = letters[Math.floor(Math.random() * letters.length)];
          picks.push(rand);
          const span = document.getElementById(`letter${i + 1}`);
          span.textContent = rand;
          
          const boxContainer = boxes[i].querySelector('.box-container');
          boxContainer.classList.add('flipped');
          
          if (i === 0) {
            firstBoxOpened = true;
            triggerConfetti();
          }
          
          if (i === 3) {
            setTimeout(() => showColorPicker(), 1200);
          }
        }, i * 300); // staggered delay for each box
      }
    }
// Color functions (kept as original)
    const colors = [
      { name: "TANSO", hex: "#A0522D" },
      { name: "PULA", hex: "#FF0000" },
      { name: "LILA", hex: "#800080" },
      { name: "BERDE", hex: "#008000" },
      { name: "ASUL", hex: "#0000FF" },
      { name: "KALIMBAHIN", hex: "#FF69B4" },
      { name: "UBE", hex: "#9370DB" },
      { name: "KAHEL", hex: "#FF6600" },
      { name: "ROSAS", hex: "#FF1493" },
      { name: "KAYUMANGGI", hex: "#8B4513" },
      { name: "LANGIT", hex: "#87CEEB" },
      { name: "GINTO", hex: "#FFD700" },
      { name: "PILAK", hex: "#808080" },
      { name: "DILAW", hex: "#FFFF00" },
      { name: "FIESTA", hex: "#FF1744" },
      { name: "ESMERALDA", hex: "#50C878" },
      { name: "TURKESA", hex: "#40E0D0" },
      { name: "MALUNGGAY", hex: "#4F7942" },
    ];

    function showColorPicker() {
      const colorPicker = document.createElement('div');
      colorPicker.className = 'fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4';
      colorPicker.innerHTML = `
        <div class="bg-white rounded-2xl p-6 max-w-2xl w-full shadow-2xl">
          <h3 class="text-gray-800 text-2xl font-bold mb-6 text-center">Pumili ng Kulay</h3>
          <div class="grid grid-cols-3 sm:grid-cols-6 gap-3 mb-6">
            ${colors.map((c, i) => `
              <button onclick="selectColor('${c.hex}', ${i})"
                class="color-btn w-full py-4 rounded-xl font-bold text-white transition-all"
                style="background-color: ${c.hex}">
                ${c.name}
              </button>
            `).join('')}
          </div>
          <div class="flex gap-3">
            <button onclick="document.querySelector('.fixed.inset-0').remove()" 
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-xl font-medium">
              Cancel
            </button>
            <button onclick="applyColor()" 
                    class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white py-3 rounded-xl font-medium shadow-lg">
              Apply Color
            </button>
          </div>
        </div>
      `;
      document.body.appendChild(colorPicker);
    }

    let selectedColor = null;
    let selectedColorIndex = null;

    function selectColor(color, index) {
      selectedColor = color;
      selectedColorIndex = index;
      document.querySelectorAll('.color-btn').forEach(btn => btn.classList.remove('selected'));
      const btn = document.querySelector(`button[onclick="selectColor('${color}', ${index})"]`);
      if (btn) btn.classList.add('selected');
    }

    function applyColor() {
      if (selectedColor) {
        for (let i = 1; i <= 4; i++) {
          const span = document.getElementById(`letter${i}`);
          span.style.textShadow = '0 0 10px rgba(255,255,255,0.8), 0 0 20px currentColor';
          
          // Set background color for each box's background
          const bg = document.querySelector(`#colorBackgrounds div[data-index="${i}"]`);
          bg.style.backgroundColor = selectedColor;
          bg.style.transform = 'scale(1.2)';
        }
        const modal = document.querySelector('.fixed.inset-0');
        if (modal) modal.remove();
        triggerConfetti();
      } else {
        alert('Please select a color');
      }
    }

    // --- PLAY BUTTON LOGIC ---
    function playTicket() {
      if (picks.length !== 4) {
        alert("Kumpletuhin muna ang 4 na letra bago mag-Play.");
        return;
      }
      if (!selectedColor && !getAppliedColor()) {
        alert("Pumili at i-apply muna ang kulay bago mag-Play.");
        return;
      }

      const letters = picks.join("");
      const colorHex = selectedColor || getAppliedColor();
      const colorName = getColorNameByHex(colorHex);
      const when = new Date().toLocaleString('en-PH');

      // Render item to history list
      const list = document.getElementById("ticketHistoryList");
      const item = document.createElement("div");
      item.className = "flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl p-3";
      item.innerHTML = `
        <div class="flex items-center gap-3">
          <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg font-bold bg-white border">${letters}</span>
          <div>
            <div class="text-sm font-semibold text-gray-800">Letters: ${letters}</div>
            <div class="text-xs text-gray-500">${when}</div>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <span class="text-sm font-medium text-gray-700">${colorName}</span>
          <div class="w-6 h-6 rounded border" style="background:${colorHex}"></div>
        </div>
      `;
      list.prepend(item);
      triggerConfetti();
    }

    function getAppliedColor() {
      // read from one of the color backgrounds if already applied
      const bg = document.querySelector('#colorBackgrounds div[data-index="1"]');
      const style = bg ? bg.style.backgroundColor : "";
      return style && style !== "transparent" ? rgbToHex(style) : null;
    }

    function getColorNameByHex(hex) {
      if (!hex) return "N/A";
      const norm = hex.toUpperCase();
      const found = colors.find(c => c.hex.toUpperCase() === norm);
      return found ? found.name : norm;
    }

    function rgbToHex(rgb) {
      // supports formats like 'rgb(255, 0, 0)' returned by style.backgroundColor
      const m = rgb.replace(/\s+/g,'').match(/^rgb\((\d+),(\d+),(\d+)\)$/i);
      if (!m) return rgb; // already hex or unexpected
      const toHex = (n) => ('0' + parseInt(n,10).toString(16)).slice(-2);
      return `#${toHex(m[1])}${toHex(m[2])}${toHex(m[3])}`.toUpperCase();
    }

    function clearHistory() {
      document.getElementById("ticketHistoryList").innerHTML = "";
    }
    // --- end PLAY BUTTON LOGIC ---

    // Barcode functions (kept same)
    function resetBarcode() { document.getElementById("barcodeInput").value = ""; }
    function submitBarcode() {
      const barcode = document.getElementById("barcodeInput").value;
      if (barcode) {
        document.getElementById("fullname").textContent = "Kuya Will";
        document.getElementById("username").textContent = "kuyawill432";
        document.getElementById("email").textContent = "kuyawill@gmail.com";
        document.getElementById("contact").textContent = "09123456789";
        document.getElementById("balance").textContent = "₱1,200.00";
      } else {
        alert("Please enter a barcode");
      }
    }

    // Subscription (kept same)
    let selectedPlan = null;
    function selectPlan(plan) {
      selectedPlan = plan;
      document.querySelectorAll('.bg-gray-100').forEach(btn => btn.classList.remove('bg-indigo-100', 'border-indigo-500'));
      try { event.target.classList.add('bg-indigo-100', 'border-indigo-500'); } catch(e) {}
    }

    function showDetails() {
      if (selectedPlan) alert("Plan Details:\n" + selectedPlan);
      else alert("Please select a plan first");
    }

    function purchaseNow() {
      if (selectedPlan) {
        const amountMatch = selectedPlan.match(/₱([\d,]+)/);
        if (amountMatch) {
          const amount = amountMatch[1].replace(/,/g, '');
          const balanceElement = document.getElementById("balance");
          const currentBalanceText = balanceElement.textContent;
          const currentBalance = parseFloat(currentBalanceText.replace(/[^\d.]/g, '')) || 0;
          const newBalance = currentBalance + parseFloat(amount);
          balanceElement.textContent = `₱${newBalance.toLocaleString('en-PH', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
          alert("Successfully purchased:\n" + selectedPlan + "\nNew Balance: ₱" + newBalance.toLocaleString('en-PH'));
          triggerConfetti();
        }
      } else {
        alert("Please select a plan first");
      }
    }

    function cancelPlan() {
      selectedPlan = null;
      document.querySelectorAll('.bg-gray-100').forEach(btn => btn.classList.remove('bg-indigo-100', 'border-indigo-500'));
    }
  </script>
</body>
</html>
