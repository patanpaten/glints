<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - {{ $application->job->title }} - Glints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .chat-container {
            height: 70vh;
            overflow-y: auto;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-radius: 15px;
            max-width: 70%;
            word-wrap: break-word;
        }
        .message.sent {
            background-color: #007bff;
            color: white;
            margin-left: auto;
        }
        .message.received {
            background-color: #f8f9fa;
            color: #333;
        }
        .message-time {
            font-size: 0.75rem;
            opacity: 0.7;
            margin-top: 5px;
        }
        .chat-input {
            border-top: 1px solid #dee2e6;
            padding: 15px;
            background-color: #f8f9fa;
        }
        .application-info {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse" style="min-height: 100vh;">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Chat</h4>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    
                    <!-- Application Info -->
                    <div class="application-info">
                        <h6 class="text-dark">Job: {{ $application->job->title }}</h6>
                        <p class="text-muted mb-2">
                            <strong>Company:</strong> {{ $application->job->company->name }}
                        </p>
                        <p class="text-muted mb-2">
                            <strong>Applicant:</strong> {{ $application->jobSeeker->user->name }}
                        </p>
                        <p class="text-muted mb-0">
                            <strong>Status:</strong> 
                            <span class="badge bg-{{ $application->status === 'pending' ? 'warning' : ($application->status === 'shortlisted' ? 'primary' : ($application->status === 'rejected' ? 'danger' : 'success')) }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </p>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-3">
                        <h6 class="text-white">Quick Actions</h6>
                        @if(Auth::user()->isCompany())
                            <div class="d-grid gap-2">
                                <a href="{{ route('company.applications.show', $application->id) }}" class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-eye"></i> View Application
                                </a>
                                <button class="btn btn-outline-light btn-sm" onclick="updateStatus('shortlisted')">
                                    <i class="bi bi-check-circle"></i> Shortlist
                                </button>
                                <button class="btn btn-outline-light btn-sm" onclick="updateStatus('rejected')">
                                    <i class="bi bi-x-circle"></i> Reject
                                </button>
                            </div>
                        @else
                            <div class="d-grid gap-2">
                                <a href="{{ route('jobseeker.applications.show', $application->id) }}" class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-eye"></i> View Application
                                </a>
                                <button class="btn btn-outline-light btn-sm" onclick="withdrawApplication()">
                                    <i class="bi bi-x-circle"></i> Withdraw
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Chat Area -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Chat with {{ Auth::user()->isCompany() ? $application->jobSeeker->user->name : $application->job->company->name }}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="refreshChat()">
                                <i class="bi bi-arrow-clockwise"></i> Refresh
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Chat Messages -->
                <div class="chat-container" id="chatContainer">
                    @foreach($messages as $message)
                        <div class="message {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}">
                            <div class="message-content">
                                {{ $message->message }}
                            </div>
                            <div class="message-time">
                                {{ $message->created_at->format('M d, H:i') }}
                                @if($message->sender_id === Auth::id())
                                    <i class="bi bi-check2-all {{ $message->is_read ? 'text-primary' : 'text-muted' }}"></i>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Chat Input -->
                <div class="chat-input">
                    <form id="chatForm" action="{{ route('chat.send', $application->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-send"></i> Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-scroll to bottom
        function scrollToBottom() {
            const container = document.getElementById('chatContainer');
            container.scrollTop = container.scrollHeight;
        }

        // Scroll to bottom on page load
        window.onload = function() {
            scrollToBottom();
        };

        // Handle form submission
        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const messageInput = this.querySelector('input[name="message"]');
            const message = messageInput.value.trim();
            
            if (!message) return;
            
            // Add message to chat immediately (optimistic update)
            addMessageToChat(message, true);
            messageInput.value = '';
            
            // Send message to server
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mark message as sent
                    markLastMessageAsSent();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Remove optimistic message on error
                removeLastMessage();
            });
        });

        // Add message to chat
        function addMessageToChat(message, isSent = false) {
            const container = document.getElementById('chatContainer');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${isSent ? 'sent' : 'received'}`;
            
            const now = new Date();
            const timeString = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) + 
                              ', ' + now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            
            messageDiv.innerHTML = `
                <div class="message-content">${message}</div>
                <div class="message-time">
                    ${timeString}
                    ${isSent ? '<i class="bi bi-check2 text-muted"></i>' : ''}
                </div>
            `;
            
            container.appendChild(messageDiv);
            scrollToBottom();
        }

        // Mark last message as sent
        function markLastMessageAsSent() {
            const lastMessage = document.querySelector('.message.sent:last-child .message-time i');
            if (lastMessage) {
                lastMessage.className = 'bi bi-check2-all text-primary';
            }
        }

        // Remove last message (on error)
        function removeLastMessage() {
            const container = document.getElementById('chatContainer');
            const lastMessage = container.querySelector('.message:last-child');
            if (lastMessage) {
                container.removeChild(lastMessage);
            }
        }

        // Refresh chat
        function refreshChat() {
            location.reload();
        }

        // Update application status (for companies)
        function updateStatus(status) {
            if (confirm(`Are you sure you want to mark this application as ${status}?`)) {
                fetch(`{{ route('company.applications.update-status', $application->id) }}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }

        // Withdraw application (for job seekers)
        function withdrawApplication() {
            if (confirm('Are you sure you want to withdraw this application?')) {
                fetch(`{{ route('jobseeker.applications.withdraw', $application->id) }}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }

        // Auto-refresh chat every 30 seconds
        setInterval(function() {
            // Only refresh if user is at bottom of chat
            const container = document.getElementById('chatContainer');
            const isAtBottom = container.scrollTop + container.clientHeight >= container.scrollHeight - 10;
            
            if (isAtBottom) {
                // Check for new messages without full page reload
                fetch('{{ route("chat.getConversations") }}')
                    .then(response => response.json())
                    .then(data => {
                        // Simple check - if there are new messages, reload
                        // In production, you'd implement proper real-time updates
                    });
            }
        }, 30000);
    </script>
</body>
</html>
