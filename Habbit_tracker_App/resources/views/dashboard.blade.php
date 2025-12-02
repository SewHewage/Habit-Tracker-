<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Habit Tracker - Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif; background: #fafafa; color: #333; min-height: 100vh; }
        .navbar { background: #fff; padding: 20px 60px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e5e5; }
        .logo { display: flex; align-items: center; gap: 12px; font-size: 20px; font-weight: 500; color: #1a1a1a; }
        .logo-icon { width: 36px; height: 36px; background: #6366f1; border-radius: 8px; display: flex; justify-content: center; align-items: center; color: white; font-size: 18px; }
        .user-menu { display: flex; align-items: center; gap: 24px; }
        .user-info { display: flex; align-items: center; gap: 12px; color: #666; font-size: 14px; }
        .avatar { width: 36px; height: 36px; background: #6366f1; border-radius: 50%; display: flex; justify-content: center; align-items: center; color: white; font-weight: 500; font-size: 14px; }
        .btn-logout { padding: 8px 18px; background: #fff; color: #666; border: 1px solid #e5e5e5; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500; transition: all 0.2s; }
        .btn-logout:hover { background: #f9fafb; border-color: #d1d5db; }
        .container { max-width: 1200px; margin: 0 auto; padding: 48px 24px; }
        .header h1 { font-size: 32px; font-weight: 600; color: #1a1a1a; margin-bottom: 8px; }
        .header p { color: #666; font-size: 16px; margin-bottom: 32px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 48px; }
        .stat-card { background: white; padding: 28px; border-radius: 12px; border: 1px solid #e5e5e5; transition: all 0.2s; }
        .stat-card:hover { border-color: #6366f1; box-shadow: 0 4px 12px rgba(99,102,241,0.08); }
        .stat-header { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; justify-content: center; align-items: center; font-size: 20px; }
        .stat-label { color: #666; font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-number { font-size: 36px; font-weight: 600; color: #1a1a1a; }
        .habits-section { background: white; padding: 32px; border-radius: 12px; border: 1px solid #e5e5e5; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        .section-header h2 { font-size: 20px; font-weight: 600; color: #1a1a1a; }
        .btn-add { padding: 10px 20px; background: #6366f1; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 6px; transition: all 0.2s; }
        .btn-add:hover { background: #4f46e5; }
        .habits-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; }
        .habit-card { background: #fafafa; padding: 24px; border-radius: 10px; border: 1px solid #e5e5e5; transition: all 0.2s; cursor: pointer; }
        .habit-card:hover { border-color: #6366f1; background: #f9fafb; }
        .habit-card.completed-today { background: #f0fdf4; border-color: #22c55e; }
        .habit-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
        .habit-info { flex: 1; }
        .habit-name { font-size: 18px; font-weight: 600; color: #1a1a1a; margin-bottom: 4px; }
        .habit-description { font-size: 13px; color: #666; }
        .habit-emoji { font-size: 28px; }
        .habit-stats { display: flex; align-items: center; gap: 16px; margin-top: 16px; padding-top: 16px; border-top: 1px solid #e5e5e5; }
        .habit-streak { display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 500; color: #666; }
        .streak-icon { font-size: 16px; }
        .week-calendar { display: flex; gap: 6px; margin-top: 16px; }
        .day-box { flex: 1; padding: 8px 4px; text-align: center; background: white; border: 1px solid #e5e5e5; border-radius: 6px; font-size: 11px; transition: all 0.2s; }
        .day-box.completed { background: #22c55e; border-color: #22c55e; color: white; }
        .day-name { font-weight: 600; margin-bottom: 4px; }
        .modal { display: none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.4); z-index:1000; align-items: center; justify-content: center; }
        .modal.active { display: flex; }
        .modal-content { background: white; padding: 32px; border-radius: 12px; max-width: 480px; width: 90%; border: 1px solid #e5e5e5; }
        .modal-header h2 { font-size: 24px; font-weight: 600; color: #1a1a1a; margin-bottom: 6px; }
        .modal-header p { color: #666; font-size: 14px; margin-bottom: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #1a1a1a; font-size: 14px; margin-bottom: 8px; font-weight: 500; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #e5e5e5; border-radius: 8px; font-size: 14px; transition: all 0.2s; font-family: inherit; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.1); }
        .form-group textarea { resize: vertical; min-height: 80px; }
        .emoji-picker { display: flex; gap: 8px; flex-wrap: wrap; }
        .emoji-option { font-size: 28px; cursor: pointer; padding: 10px; border-radius: 8px; border: 2px solid transparent; transition: all 0.2s; }
        .emoji-option:hover { background: #f9fafb; border-color: #e5e5e5; }
        .emoji-option.selected { background: #eff6ff; border-color: #6366f1; }
        .modal-actions { display: flex; gap: 12px; margin-top: 28px; }
        .btn-submit { flex:1; padding:12px; background:#6366f1; color:white; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:500; transition: all 0.2s; }
        .btn-submit:hover { background:#4f46e5; }
        .btn-cancel { flex:1; padding:12px; background:white; color:#666; border:1px solid #e5e5e5; border-radius:8px; cursor:pointer; font-size:14px; font-weight:500; transition: all 0.2s; }
        .btn-cancel:hover { background:#f9fafb; }
        .empty-state { text-align: center; padding: 60px 20px; color: #666; }
        .empty-state-icon { font-size: 64px; margin-bottom: 16px; opacity: 0.5; }
        .empty-state h3 { font-size: 20px; margin-bottom: 8px; color: #1a1a1a; }
        @media (max-width: 768px) {
            .navbar { padding:16px 20px; }
            .container { padding: 32px 16px; }
            .stats-grid, .habits-grid { grid-template-columns: 1fr; }
            .modal-content { padding: 24px; }
            .header h1 { font-size: 26px; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <div class="logo-icon">✓</div>
            <span>Habit Tracker</span>
        </div>
        <div class="user-menu">
            <div class="user-info">
                <div class="avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 2)) }}</div>
                <span>{{ $user->name ?? 'User' }}</span>
            </div>
            <form method="POST" action="{{ route('logout.perform') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <div class="header">
            <h1 id="greeting">Good morning, {{ explode(' ', $user->name ?? 'User')[0] }}</h1>
            <p>Let's make today count with your daily habits</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">🎯</div>
                    <div class="stat-label">Active Habits</div>
                </div>
                <div class="stat-number" id="activeHabits">0</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">🔥</div>
                    <div class="stat-label">Current Streak</div>
                </div>
                <div class="stat-number" id="currentStreak">0</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">✅</div>
                    <div class="stat-label">Completion</div>
                </div>
                <div class="stat-number" id="completionPercent">0%</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">⭐</div>
                    <div class="stat-label">Total Points</div>
                </div>
                <div class="stat-number" id="totalPoints">0</div>
            </div>
        </div>

        <div class="habits-section">
            <div class="section-header">
                <h2>My Habits</h2>
                <button class="btn-add" onclick="openModal()"><span>+</span> <span>New Habit</span></button>
            </div>
            <div class="habits-grid" id="habitsGrid">
                <div class="empty-state">
                    <div class="empty-state-icon">📝</div>
                    <h3>No habits yet</h3>
                    <p>Create your first habit to get started!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="habitModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Create New Habit</h2>
                <p>Build a routine that sticks</p>
            </div>
            <form id="habitForm">
                <div class="form-group">
                    <label>Habit Name</label>
                    <input type="text" id="habitName" placeholder="e.g., Morning Meditation" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea id="habitDescription" placeholder="What makes this habit important?"></textarea>
                </div>
                <div class="form-group">
                    <label>Choose an Icon</label>
                    <div class="emoji-picker">
                        <span class="emoji-option selected" data-emoji="🏃">🏃</span>
                        <span class="emoji-option" data-emoji="📚">📚</span>
                        <span class="emoji-option" data-emoji="💪">💪</span>
                        <span class="emoji-option" data-emoji="🧘">🧘</span>
                        <span class="emoji-option" data-emoji="💧">💧</span>
                        <span class="emoji-option" data-emoji="🥗">🥗</span>
                        <span class="emoji-option" data-emoji="😴">😴</span>
                        <span class="emoji-option" data-emoji="✍️">✍️</span>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn-submit">Create Habit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let habits = [];
        let selectedEmoji = "🏃";
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const userName = "{{ $user->name ?? 'User' }}";

        // Set greeting based on time
        function setGreeting() {
            const hour = new Date().getHours();
            const firstName = userName.split(' ')[0];
            let greeting = "Good morning";

            if (hour >= 12 && hour < 17) greeting = "Good afternoon";
            else if (hour >= 17) greeting = "Good evening";

            document.getElementById('greeting').textContent = `${greeting}, ${firstName}`;
        }

        // Fetch habits
        async function fetchHabits() {
            try {
                const response = await fetch('/habits', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    credentials: 'same-origin'
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                habits = await response.json();
                console.log('Fetched habits:', habits);
                renderHabits();
                updateStats();
            } catch (error) {
                console.error('Error fetching habits:', error);
                document.getElementById('habitsGrid').innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">⚠️</div>
                        <h3>Error loading habits</h3>
                        <p>${error.message}</p>
                    </div>
                `;
            }
        }

        function renderHabits() {
            const grid = document.getElementById('habitsGrid');

            if (!habits || habits.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">📝</div>
                        <h3>No habits yet</h3>
                        <p>Create your first habit to get started!</p>
                    </div>
                `;
                return;
            }

            grid.innerHTML = '';
            const days = ['M','T','W','T','F','S','S'];

            habits.forEach(habit => {
                const card = document.createElement('div');
                const completed = Array.isArray(habit.completed) ? habit.completed : [];
                const isTodayCompleted = completed[6] || false;
                card.className = `habit-card ${isTodayCompleted ? 'completed-today' : ''}`;

                const weekCalendar = days.map((day, i) => `
                    <div class="day-box ${completed[i] ? 'completed' : ''}">
                        <div class="day-name">${day}</div>
                        <div>${completed[i] ? '✓' : '○'}</div>
                    </div>`).join('');

                card.innerHTML = `
                    <div class="habit-header">
                        <div class="habit-info">
                            <div class="habit-name">${habit.name || 'Untitled Habit'}</div>
                            <div class="habit-description">${habit.description || ''}</div>
                        </div>
                        <div class="habit-emoji">${habit.emoji || '🏃'}</div>
                    </div>
                    <div class="habit-stats">
                        <div class="habit-streak"><span class="streak-icon">🔥</span> ${habit.streak || 0} days</div>
                    </div>
                    <div class="week-calendar">${weekCalendar}</div>
                `;

                card.addEventListener('click', () => toggleHabit(habit.id));
                grid.appendChild(card);
            });
        }

        async function toggleHabit(id) {
            try {
                const habit = habits.find(h => h.id === id);
                if (!habit) return;

                // Ensure completed is an array
                if (!Array.isArray(habit.completed)) {
                    habit.completed = [false, false, false, false, false, false, false];
                }

                habit.completed[6] = !habit.completed[6];
                if (habit.completed[6]) {
                    habit.streak = (habit.streak || 0) + 1;
                } else {
                    habit.streak = Math.max(0, (habit.streak || 0) - 1);
                }

                const response = await fetch(`/habits/${habit.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        completed: habit.completed,
                        streak: habit.streak
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                renderHabits();
                updateStats();
            } catch (error) {
                console.error('Error toggling habit:', error);
                alert('Failed to update habit. Please try again.');
            }
        }

        document.getElementById('habitForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const newHabit = {
                name: document.getElementById('habitName').value.trim(),
                emoji: selectedEmoji,
                description: document.getElementById('habitDescription').value.trim(),
                streak: 0,
                completed: [false, false, false, false, false, false, false]
            };

            if (!newHabit.name) {
                alert('Please enter a habit name');
                return;
            }

            try {
                const response = await fetch('{{ route("habits.index") }}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            });


                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const habit = await response.json();
                habits.push(habit);
                renderHabits();
                updateStats();
                closeModal();
            } catch (error) {
                console.error('Error creating habit:', error);
                alert('Failed to create habit. Please try again.');
            }
        });

        function updateStats() {
            const active = habits.length;
            const streak = habits.reduce((sum, h) => sum + (h.streak || 0), 0);

            let totalCompleted = 0;
            habits.forEach(h => {
                if (Array.isArray(h.completed)) {
                    totalCompleted += h.completed.filter(c => c).length;
                }
            });

            const completion = habits.length ? Math.round((totalCompleted / (habits.length * 7)) * 100) : 0;
            const points = habits.reduce((sum, h) => sum + ((h.streak || 0) * 10), 0);

            document.getElementById('activeHabits').textContent = active;
            document.getElementById('currentStreak').textContent = streak;
            document.getElementById('completionPercent').textContent = completion + '%';
            document.getElementById('totalPoints').textContent = points;
        }

        function openModal() {
            document.getElementById('habitModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('habitModal').classList.remove('active');
            document.getElementById('habitForm').reset();
            document.querySelectorAll('.emoji-option').forEach(o => o.classList.remove('selected'));
            document.querySelector('.emoji-option[data-emoji="🏃"]').classList.add('selected');
            selectedEmoji = "🏃";
        }

        // Emoji selection
        document.querySelectorAll('.emoji-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.emoji-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                selectedEmoji = this.dataset.emoji;
            });
        });

        // Close modal on outside click
        document.getElementById('habitModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Initialize
        setGreeting();
        fetchHabits();
    </script>
</body>
</html>
