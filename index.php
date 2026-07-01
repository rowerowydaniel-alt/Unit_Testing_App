<?php
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
header("Strict-Transport-Security: max-age=63072000; includeSubDomains; preload");
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self';");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestRunner Pro — Automated PHP Unit Testing</title>
    <meta name="description" content="Simple PHP Unit Test Runner — lightweight tool for running and analyzing PHP unit tests directly in the browser.">
    <meta name="keywords" content="PHP, Unit Testing, Test Runner, Browser">
    <link rel="canonical" href="https://unit-testing-app.seowisely.pl/index.php">
    <meta name="robots" content="index, follow">

    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <link rel="apple-touch-icon" href="/assets/favicon.png">

    <meta property="og:title" content="TestRunner Pro">
    <meta property="og:description" content="Automated PHP Unit Testing Made Simple">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://unit-testing-app.seowisely.pl/">
    <meta property="og:image" content="https://unit-testing-app.seowisely.pl/assets/og_image.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="unit-testing-app.seowisely.pl">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:             #07091a;
            --bg2:            #0b0f22;
            --glass:          rgba(255,255,255,0.04);
            --glass-hover:    rgba(255,255,255,0.07);
            --glass-border:   rgba(255,255,255,0.08);
            --blue:           #3b82f6;
            --blue-dim:       rgba(59,130,246,0.14);
            --blue-glow:      rgba(59,130,246,0.28);
            --blue-light:     #60a5fa;
            --text:           #e8eeff;
            --text-muted:     #7a89a8;
            --text-dim:       #424e66;
            --green:          #22c55e;
            --green-dim:      rgba(34,197,94,0.14);
            --red:            #ef4444;
            --red-dim:        rgba(239,68,68,0.14);
            --sidebar-w:      230px;
            --radius:         12px;
            --radius-sm:      8px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100dvh;
            display: flex;
            overflow-x: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100dvh;
            background: var(--bg2);
            border-right: 1px solid var(--glass-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            z-index: 100;
            transition: transform 0.25s ease;
        }

        .sidebar-logo {
            padding: 22px 18px;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 34px; height: 34px;
            background: var(--blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 18px var(--blue-glow);
            flex-shrink: 0;
        }

        .logo-icon svg { width: 17px; height: 17px; color: #fff; }

        .logo-text {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: -0.3px;
        }

        .logo-text span { color: var(--blue-light); }

        .sidebar-nav { padding: 14px 10px; flex: 1; }

        .nav-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-dim);
            padding: 0 8px;
            margin: 16px 0 5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: var(--radius-sm);
            color: var(--text-muted);
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .nav-item:hover { background: var(--glass); color: var(--text); }

        .nav-item.active {
            background: var(--blue-dim);
            color: var(--blue-light);
            border-color: rgba(59,130,246,0.18);
        }

        .nav-item svg { width: 15px; height: 15px; flex-shrink: 0; }

        .nav-badge {
            margin-left: auto;
            background: var(--blue-dim);
            color: var(--blue-light);
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .sidebar-footer {
            padding: 12px 10px;
            border-top: 1px solid var(--glass-border);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100dvh;
        }

        /* ── TOPBAR ── */
        .topbar {
            padding: 13px 30px;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(7,9,26,0.85);
            backdrop-filter: blur(14px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .breadcrumb {
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .breadcrumb span { color: var(--text); font-weight: 500; }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .pill {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-muted);
            padding: 5px 12px;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
        }

        .pill-dot {
            width: 6px; height: 6px;
            background: var(--green);
            border-radius: 50%;
            box-shadow: 0 0 6px var(--green);
            animation: blink 2s ease-in-out infinite;
        }

        @keyframes blink { 0%,100% { opacity:1; } 50% { opacity:.35; } }

        .menu-toggle {
            display: none;
            padding: 7px;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 7px;
            cursor: pointer;
            color: var(--text);
            align-items: center;
            justify-content: center;
        }

        .menu-toggle svg { width: 17px; height: 17px; }

        /* ── CONTENT ── */
        .content { padding: 30px 32px; flex: 1; }

        /* ── HERO ── */
        .hero {
            text-align: center;
            padding: 46px 20px 38px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -80px; left: 50%;
            transform: translateX(-50%);
            width: 700px; height: 320px;
            background: radial-gradient(ellipse, rgba(59,130,246,0.11) 0%, transparent 68%);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 14px;
            background: var(--blue-dim);
            border: 1px solid rgba(59,130,246,0.22);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: var(--blue-light);
            margin-bottom: 20px;
        }

        .badge-dot {
            width: 6px; height: 6px;
            background: var(--blue);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--blue);
        }

        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(26px, 4vw, 46px);
            font-weight: 700;
            letter-spacing: -1.2px;
            line-height: 1.1;
            margin-bottom: 14px;
        }

        .hero h1 .gradient {
            background: linear-gradient(135deg, var(--blue-light) 0%, #a78bfa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-tagline {
            font-size: 15.5px;
            color: var(--text-muted);
            max-width: 460px;
            margin: 0 auto 34px;
            line-height: 1.65;
        }

        /* ── URL PANEL ── */
        .url-panel {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 20px 22px;
            margin-bottom: 26px;
        }

        .panel-label {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: var(--text-dim);
            margin-bottom: 12px;
        }

        .url-row { display: flex; gap: 10px; align-items: stretch; }

        .url-wrap { position: relative; flex: 1; }

        .url-icon {
            position: absolute;
            left: 13px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-dim);
            pointer-events: none;
            display: flex;
        }

        .url-icon svg { width: 15px; height: 15px; }

        #targetUrl {
            width: 100%;
            padding: 12px 14px 12px 38px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-sm);
            color: var(--text);
            font-family: 'JetBrains Mono', monospace;
            font-size: 13.5px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        #targetUrl::placeholder { color: var(--text-dim); font-family: 'DM Sans', sans-serif; font-size: 13.5px; }

        #targetUrl:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px var(--blue-dim), 0 0 22px rgba(59,130,246,0.09);
        }

        .btn-primary {
            padding: 12px 22px;
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.15s, box-shadow 0.15s, transform 0.1s;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: var(--blue-light);
            box-shadow: 0 0 22px rgba(59,130,246,0.38);
            transform: translateY(-1px);
        }

        .btn-primary:active { transform: translateY(0); }

        .btn-primary:focus-visible { outline: 2px solid var(--blue-light); outline-offset: 2px; }

        /* ── TEST CARDS ── */
        .section-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 14.5px;
            font-weight: 600;
        }

        .section-count { font-size: 12px; color: var(--text-muted); }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(155px, 1fr));
            gap: 9px;
            margin-bottom: 26px;
        }

        .test-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 14px 15px;
            cursor: pointer;
            transition: background 0.18s, border-color 0.18s, box-shadow 0.18s, transform 0.15s;
            display: flex;
            flex-direction: column;
            gap: 9px;
            position: relative;
            overflow: hidden;
        }

        .test-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--blue);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.2s ease;
        }

        .test-card:hover {
            background: var(--glass-hover);
            border-color: rgba(59,130,246,0.4);
            box-shadow: 0 6px 28px rgba(59,130,246,0.12);
            transform: translateY(-2px);
        }

        .test-card:hover::after { transform: scaleX(1); }

        .test-card:active { transform: translateY(0); }

        .test-card:focus-visible { outline: 2px solid var(--blue); outline-offset: 2px; }

        .card-icon {
            width: 32px; height: 32px;
            background: var(--blue-dim);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue-light);
        }

        .card-icon svg { width: 15px; height: 15px; }

        .test-card.secondary .card-icon {
            background: rgba(255,255,255,0.05);
            color: var(--text-muted);
        }

        .card-name { font-size: 12.5px; font-weight: 600; line-height: 1.3; }

        .card-tag {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-dim);
        }

        /* ── PANELS ROW ── */
        .panels-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .panel {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .panel-head {
            padding: 13px 18px;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .panel-title svg { width: 13px; height: 13px; color: var(--blue-light); }

        .panel-meta { font-size: 11px; color: var(--text-dim); }

        /* ── TABLE ── */
        .table-wrap { overflow-x: auto; max-height: 360px; overflow-y: auto; }

        .table-wrap::-webkit-scrollbar { width: 5px; }
        .table-wrap::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }

        table { width: 100%; border-collapse: collapse; font-size: 12.5px; }

        thead th {
            padding: 9px 15px;
            text-align: left;
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: var(--text-dim);
            background: rgba(0,0,0,0.25);
            position: sticky;
            top: 0;
            white-space: nowrap;
        }

        tbody tr { border-bottom: 1px solid rgba(255,255,255,0.04); transition: background 0.12s; }
        tbody tr:hover { background: rgba(255,255,255,0.03); }

        tbody td { padding: 9px 15px; color: var(--text-muted); vertical-align: middle; }

        .td-id { color: var(--text-dim); font-family: 'JetBrains Mono', monospace; font-size: 11px; }
        .td-name { color: var(--text); font-weight: 500; font-size: 12.5px; }
        .td-method { font-size: 10.5px; color: var(--text-dim); font-family: 'JetBrains Mono', monospace; }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 10.5px;
            font-weight: 700;
        }

        .status-badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-passed  { background: var(--green-dim); color: var(--green); }
        .badge-failed  { background: var(--red-dim);   color: var(--red);   }
        .badge-pending { background: rgba(255,255,255,0.05); color: var(--text-dim); }

        .btn-run {
            padding: 5px 12px;
            background: var(--blue-dim);
            color: var(--blue-light);
            border: 1px solid rgba(59,130,246,0.2);
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
            font-family: 'DM Sans', sans-serif;
            white-space: nowrap;
        }

        .btn-run:hover { background: var(--blue); color: #fff; border-color: var(--blue); }
        .btn-run:focus-visible { outline: 2px solid var(--blue); outline-offset: 2px; }

        /* ── TERMINAL ── */
        .terminal {
            background: #020408;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            line-height: 1.75;
            height: 360px;
            overflow-y: auto;
            padding: 15px 17px;
        }

        .terminal::-webkit-scrollbar { width: 5px; }
        .terminal::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }

        .t-line {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            animation: fadeUp 0.18s ease forwards;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(3px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .t-prompt { color: var(--text-dim); user-select: none; flex-shrink: 0; }

        .t-line.success .t-msg { color: var(--green); }
        .t-line.error   .t-msg { color: var(--red); }
        .t-line.info    .t-msg { color: var(--text-muted); }
        .t-line.default .t-msg { color: #7fb3ff; }

        .btn-clear {
            font-size: 11px;
            color: var(--text-dim);
            background: none;
            border: none;
            cursor: pointer;
            padding: 3px 8px;
            border-radius: 5px;
            font-family: 'DM Sans', sans-serif;
            transition: color 0.12s, background 0.12s;
        }

        .btn-clear:hover { color: var(--text); background: rgba(255,255,255,0.06); }
        .btn-clear:focus-visible { outline: 2px solid var(--blue); outline-offset: 2px; }

        /* ── FOOTER ── */
        footer {
            padding: 16px 32px;
            border-top: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            color: var(--text-dim);
        }

        footer a { color: var(--blue-light); text-decoration: none; }
        footer a:hover { text-decoration: underline; }

        /* ── OVERLAY ── */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 99;
            backdrop-filter: blur(3px);
        }

        .overlay.on { display: block; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1080px) {
            .panels-row { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); box-shadow: 0 0 50px rgba(0,0,0,0.7); }
            .main { margin-left: 0; }
            .content { padding: 18px 16px; }
            .topbar { padding: 11px 16px; }
            .menu-toggle { display: inline-flex; }
            .hero { padding: 30px 12px 24px; }
            .url-row { flex-direction: column; }
            .btn-primary { width: 100%; text-align: center; }
            .cards-grid { grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); }
            footer { padding: 14px 16px; }
        }

        @media (max-width: 420px) {
            .cards-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<!-- ── SIDEBAR ── -->
<aside class="sidebar" id="sidebar" aria-label="Main navigation">
    <div class="sidebar-logo">
        <div class="logo-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
        </div>
        <div class="logo-text">Test<span>Runner</span></div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Main</div>

        <a class="nav-item active" href="#" aria-current="page">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>

        <a class="nav-item" href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Test Runner
            <span class="nav-badge">Live</span>
        </a>

        <div class="nav-label">Reports</div>

        <a class="nav-item" href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            History
        </a>

        <a class="nav-item" href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            Logs
        </a>

        <div class="nav-label">System</div>

        <a class="nav-item" href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
            Integrations
        </a>

        <a class="nav-item" href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            Settings
        </a>
    </nav>

    <div class="sidebar-footer">
        <a class="nav-item" href="https://github.com/rowerowydaniel-alt/Unit_Testing_App" target="_blank" rel="noopener noreferrer">
            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.09.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.603-3.369-1.34-3.369-1.34-.454-1.154-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.532 1.03 1.532 1.03.891 1.529 2.341 1.087 2.912.832.09-.647.349-1.086.635-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.03-2.682-.103-.253-.447-1.27.098-2.646 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.547 1.376.203 2.394.1 2.646.64.698 1.026 1.591 1.026 2.682 0 3.841-2.337 4.687-4.565 4.935.359.309.678.919.678 1.852 0 1.335-.012 2.415-.012 2.741 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
            GitHub
        </a>
    </div>
</aside>

<!-- ── MAIN ── -->
<div class="main">

    <header class="topbar">
        <div style="display:flex;align-items:center;gap:11px;">
            <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation" aria-controls="sidebar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
            <div class="breadcrumb">Dashboard / <span>Test Runner</span></div>
        </div>
        <div class="topbar-right">
            <div class="pill" role="status" aria-label="System status: online">
                <div class="pill-dot" aria-hidden="true"></div>
                System online
            </div>
        </div>
    </header>

    <div class="content">

        <!-- Hero -->
        <section class="hero" aria-label="Product header">
            <div class="hero-badge" aria-label="Version 1.0 PHP Unit Testing">
                <div class="badge-dot" aria-hidden="true"></div>
                v1.0 · PHP Unit Testing
            </div>
            <h1>PHP Unit Testing<br><span class="gradient">Made Simple</span></h1>
            <p class="hero-tagline">Run comprehensive unit tests and web scans instantly — no setup, no overhead.</p>
        </section>

        <!-- URL Input -->
        <div class="url-panel" role="region" aria-label="Target URL configuration">
            <div class="panel-label">Target URL</div>
            <div class="url-row">
                <div class="url-wrap">
                    <div class="url-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <input type="url" id="targetUrl" placeholder="https://example.com" aria-label="Website URL to test" autocomplete="url">
                </div>
                <button class="btn-primary" onclick="handleUrl()">Set Target URL</button>
            </div>
        </div>

        <!-- Web Scan Cards -->
        <div class="section-row">
            <div class="section-title">Web Scan Tests</div>
            <div class="section-count">14 available</div>
        </div>

        <div class="cards-grid" role="list" aria-label="Available web scan tests">

            <div class="test-card" onclick="runWebTest('html_elements')" role="listitem button" tabindex="0" aria-label="Run HTML Elements test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
                <div class="card-name">HTML Elements</div>
                <div class="card-tag">Structure</div>
            </div>

            <div class="test-card" onclick="runWebTest('broken_links')" role="listitem button" tabindex="0" aria-label="Run Broken Links test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></div>
                <div class="card-name">Broken Links</div>
                <div class="card-tag">Integrity</div>
            </div>

            <div class="test-card" onclick="runWebTest('seo_tags')" role="listitem button" tabindex="0" aria-label="Run SEO Tags test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
                <div class="card-name">SEO Tags</div>
                <div class="card-tag">Visibility</div>
            </div>

            <div class="test-card" onclick="runWebTest('security_headers')" role="listitem button" tabindex="0" aria-label="Run Security Headers test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                <div class="card-name">Security Headers</div>
                <div class="card-tag">Security</div>
            </div>

            <div class="test-card" onclick="runWebTest('readability')" role="listitem button" tabindex="0" aria-label="Run Readability test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
                <div class="card-name">Readability</div>
                <div class="card-tag">UX</div>
            </div>

            <div class="test-card" onclick="runWebTest('image_optimization')" role="listitem button" tabindex="0" aria-label="Run Image Optimization test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
                <div class="card-name">Image Optim.</div>
                <div class="card-tag">Performance</div>
            </div>

            <div class="test-card" onclick="runWebTest('broken_forms')" role="listitem button" tabindex="0" aria-label="Run Broken Forms test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg></div>
                <div class="card-name">Broken Forms</div>
                <div class="card-tag">Integrity</div>
            </div>

            <div class="test-card" onclick="runWebTest('external_scripts')" role="listitem button" tabindex="0" aria-label="Run External Scripts test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg></div>
                <div class="card-name">Ext. Scripts</div>
                <div class="card-tag">Performance</div>
            </div>

            <div class="test-card secondary" onclick="runWebTest('performance')" role="listitem button" tabindex="0" aria-label="Run Performance test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
                <div class="card-name">Performance</div>
                <div class="card-tag">Metrics</div>
            </div>

            <div class="test-card secondary" onclick="runWebTest('accessibility')" role="listitem button" tabindex="0" aria-label="Run Accessibility test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="2"/><path d="M16 21v-2a4 4 0 0 0-8 0v2"/><line x1="12" y1="9" x2="12" y2="21"/><path d="M9 12l-2 4"/><path d="M15 12l2 4"/></svg></div>
                <div class="card-name">Accessibility</div>
                <div class="card-tag">A11y</div>
            </div>

            <div class="test-card secondary" onclick="runWebTest('mobile_view')" role="listitem button" tabindex="0" aria-label="Run Mobile View test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
                <div class="card-name">Mobile View</div>
                <div class="card-tag">Responsive</div>
            </div>

            <div class="test-card secondary" onclick="runWebTest('cookies')" role="listitem button" tabindex="0" aria-label="Run Cookies test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="2" r="1" fill="currentColor"/></svg></div>
                <div class="card-name">Cookies</div>
                <div class="card-tag">Privacy</div>
            </div>

            <div class="test-card secondary" onclick="runWebTest('https_redirect')" role="listitem button" tabindex="0" aria-label="Run HTTPS Redirect test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
                <div class="card-name">HTTPS Redirect</div>
                <div class="card-tag">Security</div>
            </div>

            <div class="test-card secondary" onclick="runWebTest('sitemap')" role="listitem button" tabindex="0" aria-label="Run Sitemap test">
                <div class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="6" height="6"/><rect x="15" y="3" width="6" height="6"/><rect x="9" y="15" width="6" height="6"/><path d="M6 9v3a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V9"/><line x1="12" y1="9" x2="12" y2="12"/></svg></div>
                <div class="card-name">Sitemap</div>
                <div class="card-tag">Crawlability</div>
            </div>

        </div>

        <!-- Results + Terminal -->
        <div class="panels-row">

            <!-- Unit Tests Table -->
            <div class="panel" role="region" aria-label="Unit test results">
                <div class="panel-head">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        Unit Tests
                    </div>
                    <span class="panel-meta">PHP Functions</span>
                </div>
                <div class="table-wrap">
                    <table id="testTable" aria-label="Unit test list">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Test</th>
                                <th scope="col">Status</th>
                                <th scope="col">Message</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <!-- Console Terminal -->
            <div class="panel" role="region" aria-label="Console output">
                <div class="panel-head">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 17 10 11 4 5"/><line x1="12" y1="19" x2="20" y2="19"/></svg>
                        Console Output
                    </div>
                    <button class="btn-clear" onclick="clearConsole()" aria-label="Clear console">Clear</button>
                </div>
                <div class="terminal" id="consoleLog" role="log" aria-live="polite" aria-label="Test output log">
                    <div class="t-line default"><span class="t-prompt">$</span><span class="t-msg">System ready. Awaiting instructions...</span></div>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <span>&copy; 2026 TestRunner Pro</span>
        <a href="https://github.com/rowerowydaniel-alt/Unit_Testing_App" target="_blank" rel="noopener noreferrer">GitHub &rarr;</a>
    </footer>
</div>

<script>
    const apiEndpoint = 'api/api.php';
    let csrfToken = '';

    async function fetchTests() {
        try {
            const response = await fetch(`${apiEndpoint}?action=list`);
            const data = await response.json();
            csrfToken = data.csrf_token;
            const tbody = document.querySelector('#testTable tbody');
            tbody.innerHTML = '';

            data.tests.forEach(test => {
                const status = test.status;
                let badgeClass = 'badge-pending', badgeText = '—';
                if (status === 'passed') { badgeClass = 'badge-passed'; badgeText = 'Passed'; }
                else if (status === 'failed') { badgeClass = 'badge-failed'; badgeText = 'Failed'; }
                else if (status) { badgeText = status; }

                const row = document.createElement('tr');

                const idTd = document.createElement('td');
                idTd.className = 'td-id';
                idTd.textContent = `#${test.id}`;

                const nameTd = document.createElement('td');
                const nameDiv = document.createElement('div');
                nameDiv.className = 'td-name';
                nameDiv.textContent = test.name;
                const methodDiv = document.createElement('div');
                methodDiv.className = 'td-method';
                methodDiv.textContent = `${test.method_name}()`;
                nameTd.append(nameDiv, methodDiv);

                const statusTd = document.createElement('td');
                const badge = document.createElement('span');
                badge.className = `status-badge ${badgeClass}`;
                badge.textContent = badgeText;
                statusTd.appendChild(badge);

                const msgTd = document.createElement('td');
                msgTd.style.cssText = 'font-size:11px;color:var(--text-dim);max-width:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;';
                msgTd.title = test.message || '';
                msgTd.textContent = test.message || '—';

                const actionTd = document.createElement('td');
                const btn = document.createElement('button');
                btn.className = 'btn-run';
                btn.textContent = 'Run';
                btn.setAttribute('aria-label', `Run test: ${test.name}`);
                btn.onclick = () => runTest(test.id);
                actionTd.appendChild(btn);

                row.append(idTd, nameTd, statusTd, msgTd, actionTd);
                tbody.appendChild(row);
            });
        } catch (err) {
            log('Error fetching tests: ' + err.message, 'error');
        }
    }

    function handleUrl() {
        const url = document.getElementById('targetUrl').value.trim();
        if (!url) { log('Please enter a target URL first.', 'error'); return; }
        try {
            new URL(url);
            log(`Target URL set → ${url}`, 'success');
        } catch {
            log('Invalid URL format. Include https://', 'error');
        }
    }

    async function runWebTest(testType) {
        const url = document.getElementById('targetUrl').value.trim();
        if (!url) { log('Set a target URL before running a scan.', 'error'); return; }

        const label = testType.replace(/_/g, ' ');
        log(`Running scan: ${label}...`, 'info');

        const fd = new FormData();
        fd.append('url', url);
        fd.append('test_type', testType);
        fd.append('csrf_token', csrfToken);

        try {
            const res = await fetch(`${apiEndpoint}?action=scan`, { method: 'POST', body: fd });
            const result = await res.json();
            if (result.error) {
                log(`Error: ${result.error}`, 'error');
            } else {
                log(`[${label.toUpperCase()}] ${result.message}`, result.status === 'passed' ? 'success' : 'error');
            }
        } catch (err) {
            log('Scan failed: ' + err.message, 'error');
        }
    }

    async function runTest(testId) {
        log(`Executing test #${testId}...`, 'info');

        const fd = new FormData();
        fd.append('test_id', testId);
        fd.append('csrf_token', csrfToken);

        try {
            const res = await fetch(`${apiEndpoint}?action=run`, { method: 'POST', body: fd });
            const result = await res.json();
            if (result.error) {
                log(`Error: ${result.error}`, 'error');
            } else {
                log(`[#${testId}] ${result.status.toUpperCase()} — ${result.message}`, result.status === 'passed' ? 'success' : 'error');
                fetchTests();
            }
        } catch (err) {
            log('Test failed: ' + err.message, 'error');
        }
    }

    function log(msg, type = 'default') {
        const terminal = document.getElementById('consoleLog');
        const line = document.createElement('div');
        line.className = `t-line ${type}`;
        const prompt = document.createElement('span');
        prompt.className = 't-prompt';
        prompt.textContent = '$ ';
        const text = document.createElement('span');
        text.className = 't-msg';
        text.textContent = msg;
        line.append(prompt, text);
        terminal.appendChild(line);
        terminal.scrollTop = terminal.scrollHeight;
    }

    function clearConsole() {
        document.getElementById('consoleLog').innerHTML = '';
        log('Console cleared.', 'info');
    }

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('on');
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('on');
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Enter' && e.target.classList.contains('test-card')) e.target.click();
        if (e.key === 'Escape') closeSidebar();
    });

    document.addEventListener('DOMContentLoaded', fetchTests);
</script>
</body>
</html>
