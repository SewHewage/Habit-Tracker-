<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habit Sweets - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 600;
            color: #667eea;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .btn-logout {
            padding: 8px 20px;
            background: linear-gradient(90deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Header Section */
        .header {
            background: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            margin-bottom: 10px;
        }

        .header p {
            color: #888;
            font-size: 16px;
        }

        /* Stats Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-card:nth-child(1) .stat-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card:nth-child(2) .stat-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card:nth-child(3) .stat-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card:nth-child(4) .stat-icon {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #888;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Habits Section */
        .habits-section {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-header h2 {
            color: #333;
        }

        .btn-add {
            padding: 10px 25px;
            background: linear-gradient(90deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
        }

        /* Habit Cards */
        .habits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .habit-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 25px;
            border-radius: 15px;
            transition: transform 0.3s;
            cursor: pointer;
        }

        .habit-card:hover {
            transform: translateY(-5px);
        }

        .habit-card.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .habit-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .habit-name {
            font-size: 20px;
            font-weight: 600;
        }

        .habit-emoji {
            font-size: 30px;
        }

        .habit-description {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 15px;
        }

        .habit-streak {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .streak-icon {
            font-size: 20px;
        }

        /* Week Calendar */
        .week-calendar {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .day-box {
            flex: 1;
            padding: 10px 5px;
            text-align: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 12px;
        }

        .day-box.completed {
            background: rgba(76, 217, 100, 0.3);
        }

        .day-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
        }

        .modal-header {
            margin-bottom: 25px;
        }

        .modal-header h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .emoji-picker {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .emoji-option {
            font-size: 30px;
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .emoji-option:hover {
            background: #f0f0f0;
            transform: scale(1.2);
        }

        .emoji-option.selected {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-submit {
            flex: 1;
            padding: 12px;
            background: linear-gradient(90deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
        }

        .btn-cancel {
            flex: 1;
            padding: 12px;
            background: #e0e0e0;
            color: #666;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-cancel:hover {
            background: #d0d0d0;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .habits-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <div class="logo-icon">🍬</div>
            <span>Habit Sweets</span>
        </div>
        <div class="user-menu">
            <div class="user-info">
                <div class="avatar">JD</div>
                <span>John Doe</span>
            </div>
            <button class="btn-logout">Logout</button>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Welcome back, John! 👋</h1>
            <p>Track your daily habits and build a better you</p>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🎯</div>
                <div class="stat-number">12</div>
                <div class="stat-label">Active Habits</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🔥</div>
                <div class="stat-number">45</div>
                <div class="stat-label">Day Streak</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-number">89%</div>
                <div class="stat-label">Completion Rate</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-number">234</div>
                <div class="stat-label">Total Points</div>
            </div>
        </div>

        <!-- Habits Section -->
        <div class="habits-section">
            <div class="section-header">
                <h2>Today's Habits</h2>
                <button class="btn-add" onclick="openModal()">+ Add Habit</button>
            </div>

            <div class="habits-grid" id="habitsGrid">
                <!-- Habit cards will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Add Habit Modal -->
    <div class="modal" id="habitModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Create New Habit</h2>
                <p style="color: #888; font-size: 14px;">Build a new positive routine</p>
            </div>

            <form id="habitForm">
                <div class="form-group">
                    <label>Habit Name</label>
                    <input type="text" id="habitName" placeholder="e.g., Morning Meditation" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea id="habitDescription" placeholder="Why is this habit important to you?"></textarea>
                </div>

                <div class="form-group">
                    <label>Choose an Emoji</label>
                    <div class="emoji-picker" id="emojiPicker">
                        <span class="emoji-option" data-emoji="🏃">🏃</span>
                        <span class="emoji-option" data-emoji="📚">📚</span>
                        <span class="emoji-option" data-emoji="💪">💪</span>
                        <span class="emoji-option" data-emoji="🧘">🧘</span>
                        <span class="emoji-option" data-emoji="💧">💧</span>
                        <span class="emoji-option" data-emoji="🥗">🥗</span>
                        <span class="emoji-option" data-emoji="😴">😴</span>
                        <span class="emoji-option" data-emoji="✍️">✍️</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Frequency</label>
                    <select id="habitFrequency">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn-submit">Create Habit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sample habits data
        let habits = [
            {
                id: 1,
                name: "Morning Exercise",
                emoji: "🏃",
                description: "30 minutes of cardio",
                streak: 15,
                completed: [true, true, false, true, true, true, false]
            },
            {
                id: 2,
                name: "Read Books",
                emoji: "📚",
                description: "Read at least 20 pages",
                streak: 8,
                completed: [true, false, true, true, true, false, true]
            },
            {
                id: 3,
                name: "Drink Water",
                emoji: "💧",
                description: "8 glasses per day",
                streak: 22,
                completed: [true, true, true, true, true, true, true]
            }
        ];

        let selectedEmoji = "🏃";

        // Render habits
        function renderHabits() {
            const grid = document.getElementById('habitsGrid');
            grid.innerHTML = '';

            habits.forEach(habit => {
                const card = document.createElement('div');
                card.className = 'habit-card';

                const days = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
                const weekCalendar = habit.completed.map((completed, index) =>
                    `<div class="day-box ${completed ? 'completed' : ''}">
                        <div class="day-name">${days[index]}</div>
                        <div>${completed ? '✓' : '-'}</div>
                    </div>`
                ).join('');

                card.innerHTML = `
                    <div class="habit-header">
                        <div class="habit-name">${habit.name}</div>
                        <div class="habit-emoji">${habit.emoji}</div>
                    </div>
                    <div class="habit-description">${habit.description}</div>
                    <div class="habit-streak">
                        <span class="streak-icon">🔥</span>
                        <span>${habit.streak} day streak</span>
                    </div>
                    <div class="week-calendar">
                        ${weekCalendar}
                    </div>
                `;

                card.addEventListener('click', () => toggleHabit(habit.id));
                grid.appendChild(card);
            });
        }

        // Toggle habit completion
        function toggleHabit(id) {
            const habit = habits.find(h => h.id === id);
            if (habit) {
                // Toggle today's completion (last day in array)
                habit.completed[6] = !habit.completed[6];
                renderHabits();
            }
        }

        // Modal functions
        function openModal() {
            document.getElementById('habitModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('habitModal').classList.remove('active');
            document.getElementById('habitForm').reset();
        }

        // Emoji selection
        document.querySelectorAll('.emoji-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.emoji-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                selectedEmoji = this.dataset.emoji;
            });
        });

        // Form submission
        document.getElementById('habitForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const newHabit = {
                id: habits.length + 1,
                name: document.getElementById('habitName').value,
                emoji: selectedEmoji,
                description: document.getElementById('habitDescription').value,
                streak: 0,
                completed: [false, false, false, false, false, false, false]
            };

            habits.push(newHabit);
            renderHabits();
            closeModal();
        });

        // Logout
        document.querySelector('.btn-logout').addEventListener('click', function() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '/login';
            }
        });

        // Initial render
        renderHabits();
    </script>
</body>
</html>
