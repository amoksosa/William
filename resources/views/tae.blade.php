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
      background: linear-gradient(135deg, #0f0c29, #302b63, #24243e, #1a1a2e);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      overflow-x: hidden;
    }

    .dark body {
      background: linear-gradient(135deg, #0a061f, #1e1a4a, #161530, #0d0d1a);
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

    .dark .bg-white {
      background-color: #1e293b !important;
      border-color: #334155 !important;
    }

    .dark .text-gray-800 {
      color: #e2e8f0 !important;
    }

    .dark .text-gray-700 {
      color: #cbd5e1 !important;
    }

    .dark .text-gray-600 {
      color: #94a3b8 !important;
    }

    .dark .bg-gray-100, .dark .bg-gray-50 {
      background-color: #334155 !important;
    }

    .dark .bg-gray-200 {
      background-color: #475569 !important;
      color: #e2e8f0 !important;
    }

    .dark .border-gray-200, .dark .border-gray-300 {
      border-color: #475569 !important;
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
  .header-glow::after { 
    content: ''; 
    position: absolute; 
    top: -2px; 
    left: -2px; 
    right: -2px; 
    bottom: -2px; 
    background: linear-gradient(45deg, #8b5cf6, #ec4899, #3b82f6, #8b5cf6); 
    background-size: 300% 300%;
    z-index: -1; 
    border-radius: 16px; 
    filter: blur(12px); 
    opacity: 0.7; 
    animation: gradientGlow 6s ease infinite;
  }
  @keyframes gradientGlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
.logo-container { position: relative; display: inline-block; }
    .logo-glow { position: absolute; top: -20px; left: -20px; width: calc(100% + 40px); height: calc(100% + 40px); background: radial-gradient(circle, rgba(139, 92, 246, 0.4) 0%, transparent 70%); border-radius: 50%; z-index: -1; animation: pulse-slow 3s infinite; }
  </style>
  </head>
  <script>
    // Theme detection for initial load
    if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    }
  </script>
<body class="min-h-screen flex flex-col relative overflow-x-hidden">
  <!-- Animated Background -->
  <div class="stars"></div>
  <div class="twinkling"></div>

  <!-- Confetti Canvas -->
  <canvas id="confettiCanvas" class="confetti-canvas"></canvas>

  <!-- CONTENT -->
  <div class="container mx-auto px-4 py-8 flex flex-col items-center relative z-20 min-h-[calc(100vh-150px)]">
  <!-- HEADER -->
    <div class="w-full flex justify-between items-center mb-8 p-4 bg-gradient-to-r from-indigo-900/90 via-purple-900/90 to-pink-900/90 rounded-xl shadow-2xl backdrop-blur-lg border border-indigo-500/30 header-glow dark:from-indigo-800/90 dark:via-purple-800/90 dark:to-pink-800/90">
      <div class="flex items-center space-x-4">
        <div class="relative group">
          <div class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-purple-600 rounded-full blur opacity-75 group-hover:opacity-100 transition duration-200"></div>
          <div class="relative flex items-center space-x-2 bg-indigo-800/50 rounded-full px-4 py-2">
            <i data-feather="user" class="text-white w-5 h-5"></i>
            <span class="text-white font-medium">Admin</span>
          </div>
        </div>
        <button id="themeToggle" class="relative group p-2 rounded-full bg-indigo-800/50 hover:bg-indigo-700/60 transition-all">
          <div class="absolute inset-0 rounded-full bg-gradient-to-r from-amber-200 to-yellow-400 opacity-0 group-hover:opacity-20 transition-opacity"></div>
          <i data-feather="sun" class="text-white w-5 h-5 hidden dark:block"></i>
          <i data-feather="moon" class="text-white w-5 h-5 block dark:hidden"></i>
        </button>
      </div>
      <div class="flex gap-4">
        <button class="flex flex-col items-center text-white nav-button group">
          <div class="relative p-2 mb-1">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full opacity-0 group-hover:opacity-100 transition-all"></div>
            <div class="relative bg-indigo-800/50 rounded-full p-2 group-hover:bg-transparent transition-all">
              <i data-feather="home" class="w-5 h-5"></i>
            </div>
          </div>
          <span class="text-xs font-medium text-white/90 group-hover:text-white transition-colors">Dashboard</span>
        </button>
        <button class="flex flex-col items-center text-white/70 nav-button group">
          <div class="relative p-2 mb-1">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full opacity-0 group-hover:opacity-100 transition-all"></div>
            <div class="relative bg-gray-700/50 rounded-full p-2 group-hover:bg-transparent transition-all">
              <i data-feather="credit-card" class="w-5 h-5"></i>
            </div>
          </div>
          <span class="text-xs text-white/70 group-hover:text-white transition-colors">Loading</span>
        </button>
        <button class="flex flex-col items-center text-white/70 nav-button group">
          <div class="relative p-2 mb-1">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full opacity-0 group-hover:opacity-100 transition-all"></div>
            <div class="relative bg-gray-700/50 rounded-full p-2 group-hover:bg-transparent transition-all">
              <i data-feather="user-plus" class="w-5 h-5"></i>
            </div>
          </div>
          <span class="text-xs text-white/70 group-hover:text-white transition-colors">Register</span>
        </button>
        <button class="flex flex-col items-center text-white/70 nav-button group">
          <div class="relative p-2 mb-1">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full opacity-0 group-hover:opacity-100 transition-all"></div>
            <div class="relative bg-gray-700/50 rounded-full p-2 group-hover:bg-transparent transition-all">
              <i data-feather="refresh-cw" class="w-5 h-5"></i>
            </div>
          </div>
          <span class="text-xs text-white/70 group-hover:text-white transition-colors">Replace</span>
        </button>
      </div>
      <button class="relative group bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-6 py-2 rounded-lg transition-all transform hover:scale-105 shadow-xl flex items-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <i data-feather="log-out" class="inline mr-2 relative"></i>
        <span class="relative">Logout</span>
        <div class="absolute inset-0 border border-white/10 rounded-lg group-hover:border-white/30 transition-all"></div>
      </button>
</div>
<!-- Main Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 w-full px-4 sm:px-6" data-aos="fade-up">
<!-- BARCODE -->
      <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl p-4 sm:p-6 border border-gray-200 card-hover">
<div class="flex items-center mb-4">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3">
            <i data-feather="maximize-2" class="text-indigo-600 w-5 h-5"></i>
          </div>
          <h2 class="text-gray-800 font-bold text-xl">Scan / Enter Barcode</h2>
        </div>
        <input id="barcodeInput" type="text" placeholder="Enter or scan barcode"
               class="w-full bg-gray-50 text-gray-800 border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 mb-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm sm:text-base">
        <div class="flex gap-2 sm:gap-3">
          <button onclick="resetBarcode()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-2 sm:py-3 transition-colors font-medium text-sm sm:text-base">Reset</button>
          <button onclick="submitBarcode()" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg py-2 sm:py-3 transition-all font-medium shadow-lg text-sm sm:text-base">Submit Barcode</button>
</div>
        <hr class="border-gray-200 my-4">
        <div class="flex items-center mb-3">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3">
            <i data-feather="user" class="text-indigo-600 w-5 h-5"></i>
          </div>
          <h3 class="text-gray-800 font-bold">Customer Details</h3>
        </div>
        <ul class="text-gray-600 space-y-1 sm:space-y-2">
          <li class="flex justify-between text-sm sm:text-base"><span class="text-gray-700">Full name:</span><span id="fullname" class="text-gray-900 font-medium">-</span></li>
          <li class="flex justify-between text-sm sm:text-base"><span class="text-gray-700">Username:</span><span id="username" class="text-gray-900 font-medium">-</span></li>
          <li class="flex justify-between text-sm sm:text-base"><span class="text-gray-700">Email:</span><span id="email" class="text-gray-900 font-medium">-</span></li>
          <li class="flex justify-between text-sm sm:text-base"><span class="text-gray-700">Contact:</span><span id="contact" class="text-gray-900 font-medium">-</span></li>
        </ul>
        <div class="balance-display mt-4 text-sm sm:text-base">BALANCE: <span id="balance" class="text-yellow-300">₱0.00</span></div>
</div>
      <!-- TICKET -->
      <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl p-3 border border-gray-200 card-hover">
<div class="flex items-center mb-4">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="clipboard" class="text-indigo-600 w-5 h-5"></i></div>
          <h2 class="text-gray-800 font-bold text-xl">Ticket Combination</h2>
        </div>
        <div id="canvas-container" class="w-full h-48 sm:h-64 mb-4">
<!-- 3D CUBES OR BOX -->
        </div>
        <div class="color-selection mb-4">
          <div class="color-title text-center text-gray-700 font-medium mb-2">Choose Color</div>
          <div class="color-grid grid grid-cols-4 sm:grid-cols-6 gap-2">
            <div class="color-btn border border-gray-200 sm:border-2 rounded sm:rounded-lg cursor-pointer h-8 sm:h-10" style="background: #ff6b6b;" onclick="selectColor(0, 0xff6b6b)"></div>
<div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #4ecdc4;" onclick="selectColor(1, 0x4ecdc4)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #45b7d1;" onclick="selectColor(2, 0x45b7d1)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #ffa726;" onclick="selectColor(3, 0xffa726)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #ab47bc;" onclick="selectColor(4, 0xab47bc)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #66bb6a;" onclick="selectColor(5, 0x66bb6a)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #ef5350;" onclick="selectColor(6, 0xef5350)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10 selected" style="background: #42a5f5;" onclick="selectColor(7, 0x42a5f5)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #ff7043;" onclick="selectColor(8, 0xff7043)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #ec407a;" onclick="selectColor(9, 0xec407a)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #26c6da;" onclick="selectColor(10, 0x26c6da)"></div>
            <div class="color-btn border-2 border-gray-200 rounded-lg cursor-pointer h-10" style="background: #d4e157;" onclick="selectColor(11, 0xd4e157)"></div>
          </div>
        </div>
        <div class="letters-grid grid grid-cols-5 sm:grid-cols-7 gap-1 sm:gap-2 mb-4">
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-1 sm:p-2 font-bold rounded sm:rounded-lg" onclick="selectLetter('A')">A</button>
<button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('B')">B</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('C')">C</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('D')">D</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('E')">E</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('F')">F</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('G')">G</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('H')">H</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('I')">I</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('J')">J</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('K')">K</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('L')">L</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('M')">M</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('N')">N</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('O')">O</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('P')">P</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('Q')">Q</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('R')">R</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('S')">S</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('T')">T</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('U')">U</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('V')">V</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('W')">W</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('X')">X</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('Y')">Y</button>
          <button class="letter-btn bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white p-2 font-bold rounded-lg" onclick="selectLetter('Z')">Z</button>
        </div>
        <div class="info-panel bg-gray-50 rounded-xl p-4 flex flex-col items-center">
          <div class="status text-gray-800 font-medium mb-3" id="status">Selected: 0/4</div>
          <button onclick="playSelection()" id="playBtn" class="w-full mb-3 bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white rounded-lg py-2 transition-all font-medium shadow-lg disabled:opacity-50 disabled:cursor-not-allowed" disabled>Play</button>
          <div class="flex gap-3 w-full">
<button onclick="clearBoxes()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-2 transition-colors font-medium">Reset</button>
            <button onclick="luckyPick()" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg py-2 transition-all font-medium shadow-lg">Lucky Pick</button>
          </div>
        </div>
      </div>
      <!-- SUBSCRIPTION -->
      <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl p-4 sm:p-6 border border-gray-200 card-hover">
<div class="flex items-center mb-4">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3"><i data-feather="credit-card" class="text-indigo-600 w-5 h-5"></i></div>
          <h2 class="text-gray-800 font-bold text-xl">Subscription</h2>
        </div>
        <div class="space-y-3 mb-4">
          <button onclick="selectPlan('₱120 / 1 Day')" class="w-full flex justify-between items-center bg-gray-100 dark:bg-gray-700 hover:bg-orange-500 dark:hover:bg-orange-500 text-gray-800 dark:text-gray-200 rounded-lg px-4 py-3 transition-colors font-medium"><span class="font-bold text-lg">₱120</span><span class="text-gray-600 dark:text-gray-400">1 Day</span></button>
          <button onclick="selectPlan('₱1,200 / 10 Days')" class="w-full flex justify-between items-center bg-gray-100 dark:bg-gray-700 hover:bg-orange-500 dark:hover:bg-orange-500 text-gray-800 dark:text-gray-200 rounded-lg px-4 py-3 transition-colors font-medium"><span class="font-bold text-lg">₱1,200</span><span class="text-gray-600 dark:text-gray-400">10 Days</span></button>
          <button onclick="selectPlan('₱1,800 / 15 Days')" class="w-full flex justify-between items-center bg-gray-100 dark:bg-gray-700 hover:bg-orange-500 dark:hover:bg-orange-500 text-gray-800 dark:text-gray-200 rounded-lg px-4 py-3 transition-colors font-medium"><span class="font-bold text-lg">₱1,800</span><span class="text-gray-600 dark:text-gray-400">15 Days</span></button>
          <button onclick="selectPlan('₱3,600 / 30 Days')" class="w-full flex justify-between items-center bg-gray-100 dark:bg-gray-700 hover:bg-orange-500 dark:hover:bg-orange-500 text-gray-800 dark:text-gray-200 rounded-lg px-4 py-3 transition-colors font-medium"><span class="font-bold text-lg">₱3,600</span><span class="text-gray-600 dark:text-gray-400">30 Days</span></button>
</div>
        <div class="flex gap-2 sm:gap-3 mb-3">
          <button onclick="showDetails()" class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white rounded-lg py-2 sm:py-3 transition-all font-medium shadow-lg text-sm sm:text-base">Show Details</button>
          <button onclick="purchaseNow()" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg py-2 sm:py-3 transition-all font-medium shadow-lg text-sm sm:text-base">Purchase Now</button>
</div>
        <button onclick="cancelPlan()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg py-2 sm:py-3 transition-colors font-medium text-sm sm:text-base">Cancel</button>
<!-- HISTORY NG TICKETS -->
        <div class="mt-6">
          <div class="flex items-center mb-2">
            <div class="p-2 bg-indigo-100 rounded-lg mr-3">
              <i data-feather="clock" class="text-indigo-600 w-5 h-5"></i>
            </div>
            <h3 class="text-gray-800 font-bold">Ticket History</h3>
          </div>
        <div id="ticketHistory" class="bg-orange-100 rounded-xl p-3 sm:p-4 max-h-60 overflow-y-auto">
<div class="text-center text-gray-500">No history yet</div>
          </div>
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
    // Theme toggle functionality
    const themeToggle = document.getElementById('themeToggle');
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
      document.documentElement.classList.add('dark');
    }

    themeToggle.addEventListener('click', function() {
      const isDark = document.documentElement.classList.toggle('dark');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
      feather.replace();
    });

    // Initialize AOS & icons
    AOS.init({ duration: 800, easing: 'ease-in-out' });
    feather.replace();
// Confetti
    const canvas = document.getElementById('confettiCanvas');
    const confettiInstance = confetti.create(canvas, { resize: true, useWorker: true });
    function triggerConfetti() {
      confettiInstance({ particleCount: 120, spread: 70, origin: { y: 0.6 } });
    }
    // Three.js setup
    let scene, camera, renderer, cubes = [], lettersPlanes = [], selectedLetters = [], currentCubeIndex = 0;
    let selectedColorIndex = 0;
    
    const colorPalette = [
      0xff6b6b, 0x4ecdc4, 0x45b7d1, 0xffa726, 
      0xab47bc, 0x66bb6a, 0xef5350, 0x42a5f5,
      0xff7043, 0xec407a, 0x26c6da, 0xd4e157
    ];

    function init3D() {
      // Only initialize if Three.js is loaded
      if (typeof THREE === 'undefined') {
        console.error('Three.js not loaded');
        return;
      }

      // Scene setup
      scene = new THREE.Scene();
      scene.background = null;

      // Camera setup
      const container = document.getElementById('canvas-container');
      const aspect = container.clientWidth / container.clientHeight;
      camera = new THREE.PerspectiveCamera(70, aspect, 0.1, 1000);
      camera.position.set(0, 0, 16); // moved camera back to accommodate larger cubes
// Renderer setup
      renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
      renderer.setSize(container.clientWidth, container.clientHeight);
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
      container.appendChild(renderer.domElement);

      // Lighting
      const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
      scene.add(ambientLight);

      const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
      directionalLight.position.set(1, 1, 1);
      scene.add(directionalLight);

      // Create cubes
      create3DCubes();

      // handle resizing
      window.addEventListener('resize', onWindowResize);

      animate();
    }

    function create3DCubes() {
      // clean up old
      cubes.forEach(c => {
        try { scene.remove(c); } catch(e) {}
      });
      lettersPlanes.forEach(lp => {
        try { scene.remove(lp.plane); } catch(e) {}
      });
      cubes = [];
      lettersPlanes = [];

      // true cube: equal sides
      const side = 5; // increased cube side length further
const geometry = new THREE.BoxGeometry(side, side, side);

      for (let i = 0; i < 4; i++) {
        const material = new THREE.MeshPhongMaterial({ 
          color: colorPalette[selectedColorIndex],
          shininess: 100,
          transparent: true,
          opacity: 0.9
        });

        const cube = new THREE.Mesh(geometry, material);
        // increased spacing between cubes from 4 to 5 units
        cube.position.x = (i - 1.5) * 6; // increased spacing to match larger cubes
cube.position.y = 0;
        cube.position.z = 0;
        cube.userData = { isEmpty: true, index: i };
        scene.add(cube);
        cubes.push(cube);

        // create a canvas texture for the letter (white semi-transparent background)
        const texSize = 512;
        const canvas = document.createElement('canvas');
        canvas.width = texSize;
        canvas.height = texSize;
        const ctx = canvas.getContext('2d');

        // draw empty white rounded rect area (semi-transparent) initially blank
        function drawLetterOnCanvas(letter) {
          ctx.clearRect(0, 0, texSize, texSize);
          const pad = 80;
          // white semi-transparent bg
          ctx.fillStyle = 'rgba(255,255,255,0.85)';
          roundRect(ctx, pad, pad, texSize - pad*2, texSize - pad*2, 24, true, false);
          if (letter) {
            ctx.fillStyle = '#000';
            // font size responsive to canvas
            ctx.font = "bold 220px Arial";
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            ctx.fillText(letter, texSize / 2, texSize / 2 + 10);
          }
        }
        // helper for rounded rect
        function roundRect(ctx, x, y, w, h, r, fill, stroke) {
          if (typeof stroke === 'undefined') stroke = true;
          if (typeof r === 'undefined') r = 5;
          ctx.beginPath();
          ctx.moveTo(x + r, y);
          ctx.arcTo(x + w, y,   x + w, y + h, r);
          ctx.arcTo(x + w, y + h, x,   y + h, r);
          ctx.arcTo(x,   y + h, x,   y,   r);
          ctx.arcTo(x,   y,   x + w, y,   r);
          ctx.closePath();
          if (fill) ctx.fill();
          if (stroke) ctx.stroke();
        }

        // initially draw blank (just white bg)
        drawLetterOnCanvas('');

        const texture = new THREE.CanvasTexture(canvas);
        texture.needsUpdate = true;
        const planeSize = side * 0.9; // adjust plane size proportionally to larger cube
const planeGeometry = new THREE.PlaneGeometry(planeSize, planeSize);
        const planeMaterial = new THREE.MeshBasicMaterial({ map: texture, transparent: true });
        const plane = new THREE.Mesh(planeGeometry, planeMaterial);

        // make letter plane a child of cube so it follows cube rotation
        plane.position.set(0, 0, side/2 + 0.01); // slightly in front of front face to avoid z-fight
        cube.add(plane);

        lettersPlanes.push({ canvas, ctx, texture, plane, drawLetterOnCanvas });
      }
    }
    function selectLetter(letter) {
      // prevent duplicate selection: if button is already disabled, ignore
      if (selectedLetters.length === 4) return;
      const btn = Array.from(document.querySelectorAll('.letter-btn')).find(b => b.textContent.trim() === letter);
      if (!btn || btn.disabled) return;

      if (selectedLetters.length >= 4) return;

      // assign to next available cube
      const targetIndex = currentCubeIndex;
      if (targetIndex >= cubes.length) return;

      // Store the letter and display it immediately
      selectedLetters.push(letter);
      
      // Show the letter on the cube
      const lp = lettersPlanes[targetIndex];
      if (lp) {
        lp.drawLetterOnCanvas(letter);
        lp.texture.needsUpdate = true;
      }
      // Update cube color with the currently selected color
      cubes[targetIndex].material.color.setHex(colorPalette[selectedColorIndex]);
// disable this letter button so it can't be picked again
      if (btn) btn.disabled = true;

      // animate cube (full rotation + pop)
      animate3DCube(targetIndex);

      currentCubeIndex++;

      document.getElementById('status').textContent = `Selected: ${selectedLetters.length}/4`;

      // if filled all 4, disable all letter buttons
      if (selectedLetters.length >= 4) {
        document.querySelectorAll('.letter-btn').forEach(b => b.disabled = true);
        onSelectionComplete();
      }
    }
function animate3DCube(index) {
      const cube = cubes[index];
      if (!cube) return;
      const start = performance.now();
      const duration = 800;
      const initialRot = { x: cube.rotation.x, y: cube.rotation.y, z: cube.rotation.z };
      const targetRot = { x: initialRot.x + Math.PI * 2, y: initialRot.y + Math.PI * 2, z: initialRot.z };

      function frame(now) {
        const elapsed = now - start;
        const t = Math.min(1, elapsed / duration);
        const ease = (t < 0.5) ? 2*t*t : -1 + (4 - 2*t)*t; // smooth ease

        cube.rotation.x = initialRot.x + (targetRot.x - initialRot.x) * ease;
        cube.rotation.y = initialRot.y + (targetRot.y - initialRot.y) * ease;

        const scale = 1 + Math.sin(ease * Math.PI) * 0.25;
        cube.scale.set(scale, scale, scale);

        if (t < 1) requestAnimationFrame(frame);
        else {
          // finalize - ensure cube ends up with front face forward
          cube.rotation.x = initialRot.x + Math.PI * 2;
          cube.rotation.y = initialRot.y + Math.PI * 2;
          cube.scale.set(1,1,1);
        }
}
      requestAnimationFrame(frame);
    }
    function clearBoxes() {
      selectedLetters = [];
      currentCubeIndex = 0;
      // clear plane text and restore cube states
      lettersPlanes.forEach(lp => {
        lp.drawLetterOnCanvas('');
        lp.texture.needsUpdate = true;
      });
      cubes.forEach(cube => {
        cube.rotation.set(0, 0, 0);
        cube.scale.set(1, 1, 1);
        cube.userData.isEmpty = true;
        cube.material.color.setHex(colorPalette[selectedColorIndex]);
        cube.userData.isEmpty = true;
});
// re-enable all buttons
      document.querySelectorAll('.letter-btn').forEach(btn => btn.disabled = false);
      document.getElementById('status').textContent = 'Selected: 0/4';
    }
    function luckyPick() {
      clearBoxes();
      
      // Randomly select a color first
      const randomColorIndex = Math.floor(Math.random() * colorPalette.length);
      selectColor(randomColorIndex, colorPalette[randomColorIndex]);
      
      // Get all available letters
      const availableLetters = Array.from(document.querySelectorAll('.letter-btn'))
        .filter(b => !b.disabled)
        .map(b => b.textContent.trim());
      
      // Shuffle the array and pick first 4
      const shuffledLetters = [...availableLetters].sort(() => 0.5 - Math.random());
      const randomLetters = shuffledLetters.slice(0, 4);
      
      // Animate the selection of each letter
      randomLetters.forEach((letter, i) => {
        setTimeout(() => {
          selectedLetters.push(letter);
          
          // Update the cube with the letter and color
          const lp = lettersPlanes[i];
          if (lp) {
            lp.drawLetterOnCanvas(letter);
            lp.texture.needsUpdate = true;
          }
          cubes[i].material.color.setHex(colorPalette[randomColorIndex]);
          
          // Disable the corresponding button
          const btn = Array.from(document.querySelectorAll('.letter-btn')).find(b => b.textContent.trim() === letter);
          if (btn) btn.disabled = true;
          
          document.getElementById('status').textContent = `Selected: ${selectedLetters.length}/4`;
          
          // Animate the cube
          animate3DCube(i);
          
          if (selectedLetters.length >= 4) {
            document.querySelectorAll('.letter-btn').forEach(b => b.disabled = true);
            onSelectionComplete();
          }
        }, i * 350);
      });
    }
function selectColor(colorIndex, colorHex) {
      document.querySelectorAll('.color-btn').forEach(btn => btn.classList.remove('selected'));
      document.querySelectorAll('.color-btn')[colorIndex].classList.add('selected');
      
      selectedColorIndex = colorIndex;
      
      // Update all cubes regardless of their state
      cubes.forEach(cube => {
        cube.material.color.setHex(colorHex);
      });
    }
function animate() {
      requestAnimationFrame(animate);
      
      // gentle floating for empty cubes
      const time = Date.now() * 0.001;
      cubes.forEach((cube, index) => {
        if (cube.userData.isEmpty) {
          cube.position.y = Math.sin(time + index) * 0.05;
          cube.rotation.x = Math.sin(time * 0.3 + index) * 0.02;
          cube.rotation.z = Math.cos(time * 0.2 + index) * 0.01;
        }
      });

      // ensure letters (planes as children) always face forward relative to cube by keeping them as child
      renderer.render(scene, camera);
    }

    function onWindowResize() {
      const container = document.getElementById('canvas-container');
      if (!container) return;
      camera.aspect = container.clientWidth / container.clientHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(container.clientWidth, container.clientHeight);
    }

    // Initialize when Three.js is loaded
    const threeScript = document.createElement('script');
    threeScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';
    threeScript.onload = init3D;
    document.head.appendChild(threeScript);

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
    // Ticket History
    let ticketHistory = [];
    function updateTicketHistory() {
      if (selectedLetters.length === 0 || selectedColorIndex === null) return;
      
      const historyEntry = {
        color: colorPalette[selectedColorIndex],
        letters: [...selectedLetters],
        timestamp: new Date().toLocaleTimeString(),
        colorHex: colorPalette[selectedColorIndex]
      };
      
      ticketHistory.unshift(historyEntry);
      if (ticketHistory.length > 5) ticketHistory.pop();
      
      renderTicketHistory();
    }
    function onSelectionComplete() {
      if (selectedLetters.length === 4 && selectedColorIndex !== null) {
        document.getElementById('playBtn').disabled = false;
      }
    }
    function playSelection() {
      if (selectedLetters.length === 4 && selectedColorIndex !== null) {
        // Just trigger confetti since letters are already shown
        updateTicketHistory();
        document.getElementById('playBtn').disabled = true;
        triggerConfetti();
      }
    }
function renderTicketHistory() {
      const historyContainer = document.getElementById('ticketHistory');
      
      if (ticketHistory.length === 0) {
        historyContainer.innerHTML = '<div class="text-center text-gray-500">No history yet</div>';
        return;
      }
      
      historyContainer.innerHTML = ticketHistory.map(entry => `
        <div class="flex items-center justify-between mb-3 p-3 bg-orange-50 rounded-lg border border-orange-200">
<div class="flex items-center">
            <div class="w-6 h-6 rounded mr-3" style="background-color: #${entry.colorHex.toString(16).padStart(6, '0')}"></div>
            <div>
              <span class="font-mono text-gray-700">${entry.letters.join(' ')}</span>
              <div class="text-xs text-gray-500">Color: #${entry.colorHex.toString(16).padStart(6, '0').toUpperCase()}</div>
            </div>
          </div>
          <span class="text-sm text-gray-500">${entry.timestamp}</span>
        </div>
`).join('');
    }

    // Subscription
    let selectedPlan = null;
function selectPlan(plan) {
      selectedPlan = plan;
      document.querySelectorAll('.bg-gray-100, .dark\\:bg-gray-700').forEach(btn => btn.classList.remove('bg-indigo-100', 'dark:bg-indigo-800', 'border-indigo-500'));
      try { event.target.classList.add('bg-indigo-100', 'dark:bg-indigo-800', 'border-indigo-500'); } catch(e) {}
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
      document.querySelectorAll('.bg-gray-100, .dark\\:bg-gray-700').forEach(btn => btn.classList.remove('bg-indigo-100', 'dark:bg-indigo-800', 'border-indigo-500'));
}
  </script>
</body>
</html>
