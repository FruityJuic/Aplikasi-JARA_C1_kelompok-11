<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>JARA - Task Management</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f5f7fb;
        color: #1f2937;
    }

    .container {
        display: flex;
        min-height: 100vh;
    }

    /* ================= SIDEBAR ================= */

    .sidebar {
        width: 250px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        padding: 28px 20px;
        position: fixed;
        height: 100vh;
    }

    .logo {
        font-size: 28px;
        font-weight: bold;
        color: #4f46e5;
        margin-bottom: 40px;
        padding-left: 10px;
    }

    .menu-title {
        font-size: 12px;
        color: #9ca3af;
        font-weight: bold;
        margin: 20px 10px 10px;
        text-transform: uppercase;
    }

    .menu {
        list-style: none;
    }

    .menu li {
        margin-bottom: 6px;
    }

    .menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        text-decoration: none;
        color: #6b7280;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.2s;
    }

    .menu a:hover,
    .menu a.active {
        background: #eef2ff;
        color: #4f46e5;
    }

    .icon {
        width: 20px;
        text-align: center;
    }

    /* ================= MAIN ================= */

    .main {
        margin-left: 250px;
        width: calc(100% - 250px);
        padding: 35px 45px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
    }

    .header h1 {
        font-size: 28px;
        margin-bottom: 7px;
    }

    .header p {
        color: #6b7280;
        font-size: 14px;
    }

    .user {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #4f46e5;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

    /* ================= STATISTICS ================= */

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 15px;
        padding: 22px;
    }

    .stat-card p {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .stat-card h2 {
        font-size: 30px;
    }

    .stat-card .description {
        margin-top: 8px;
        font-size: 12px;
        color: #9ca3af;
    }

    /* ================= TASK SECTION ================= */

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .section-header h2 {
        font-size: 20px;
    }

    .add-button {
        background: #4f46e5;
        color: white;
        padding: 11px 17px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
    }

    .add-button:hover {
        background: #4338ca;
    }

    /* ================= TASK CARD ================= */

    .task-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .task-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .task-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .checkbox {
        width: 21px;
        height: 21px;
        border: 2px solid #d1d5db;
        border-radius: 6px;
    }

    .checkbox.completed {
        background: #4f46e5;
        border-color: #4f46e5;
        position: relative;
    }

    .checkbox.completed::after {
        content: "✓";
        color: white;
        position: absolute;
        left: 3px;
        top: -1px;
        font-size: 14px;
    }

    .task-title {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .task-title.completed {
        text-decoration: line-through;
        color: #9ca3af;
    }

    .task-info {
        display: flex;
        gap: 12px;
        font-size: 12px;
        color: #9ca3af;
    }

    .task-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .priority {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .priority.high {
        background: #fee2e2;
        color: #dc2626;
    }

    .priority.medium {
        background: #fef3c7;
        color: #d97706;
    }

    .priority.low {
        background: #dcfce7;
        color: #16a34a;
    }

    .date {
        font-size: 12px;
        color: #6b7280;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 900px) {

        .sidebar {
            width: 200px;
        }

        .main {
            margin-left: 200px;
            width: calc(100% - 200px);
            padding: 25px;
        }

        .stats {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {

        .sidebar {
            display: none;
        }

        .main {
            margin-left: 0;
            width: 100%;
            padding: 20px;
        }

        .header {
            align-items: flex-start;
        }

        .task-card {
            align-items: flex-start;
        }

        .task-right {
            flex-direction: column;
            align-items: flex-end;
        }
    }
</style>
```

</head>

<body>

<div class="container">

```
<!-- SIDEBAR -->

<aside class="sidebar">

    <div class="logo">
        JARA
    </div>

    <div class="menu-title">
        Menu
    </div>

    <ul class="menu">

        <li>
            <a href="#" class="active">
                <span class="icon">⌂</span>
                Dashboard
            </a>
        </li>

        <li>
            <a href="#">
                <span class="icon">✓</span>
                My Tasks
            </a>
        </li>

        <li>
            <a href="#">
                <span class="icon">☷</span>
                My Lists
```
