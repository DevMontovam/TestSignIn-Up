<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>        
        body {
            margin: 0;
            padding: 0;
            background: url('https://picsum.photos/1920/1080') no-repeat center center fixed;
            background-size: cover;
            color: #000;
            height: 100vh;
        }
        .menu-container {
            background: #fff;
            width: 100%;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 9999; 
        }
        .menu-container a{
            text-decoration: none;
        }
        .menu-container a h1 {
            color: #007bff;
            margin: 0;
        }
        .menu-container nav {
            display: flex;
            gap: 20px; 
        }
        .menu-container nav button {
            background: none;
            border: 2px solid transparent;
            color: #007bff;
            text-decoration: none;
            font-size: 1.2em;
            cursor: pointer;
            padding: 5px 15px;
            border-radius: 20px;
            transition: color 0.3s, background 0.3s, border 0.3s;
            outline: none !important;
        }
            .menu-container nav button:hover {
                color: #fff;
                background: #007bff;
                border: 2px solid #007bff;
            }
        .modal-content {
            color: #000;
        }
        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translateY(-100%);
        }
        .modal.fade.show .modal-dialog {
            transform: translateY(0);
        }
        .user-list {
            margin-top: 120px; 
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .user-list .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .user-list .header h2 {
            color: #007bff;        
            display: inline-block;
            margin-right: 20px;
        }
        .user-list button {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: none;
            width: 50px; 
            height: 50px;
            border-radius: 50%;
            transition: background 0.3s, color 0.3s;
            cursor: pointer;
            display: inline-block;
            vertical-align: middle;
            outline: none !important;
            margin-top: -10px;
        }
        .user-list button img {
            filter: invert(31%) sepia(99%) saturate(4088%) hue-rotate(175deg) brightness(100%) contrast(100%);
            width: 70%; 
            height: auto;
        }
            .user-list button:hover {
                background-color: #007bff;
                outline: none !important;
            }
                .user-list button img:hover {
                    filter: brightness(0) invert(1);
                }
        .user-item {
            display: flex;
            flex-direction: column;
            justify-content: column;
            align-items: flex-start;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
            .user-item:last-child {
                border-bottom: none;
            }    
        .user-item p{
            margin-right: 1rem;
            margin-bottom: 10px;
        }
        .user-item p strong{
            color: #007bff;
            margin-right: 1rem;
        }        
        .user-item .btn-container {
            display: flex;
            gap: 10px; 
            margin-top: 10px; 
        }
        .user-item .btn-edit, .user-item .btn-delete {
            margin: 0; 
            padding: 0.25rem 1rem; 
            font-size: 0.9em;
            width: 5rem !important;
        }
        .btn-edit, .btn-delete {
            margin-left: 0.5rem !important;
            border: none !important;
            color: #fff !important;
            cursor: pointer !important;
            border-radius: 4px !important;
        }
        .btn-edit {
            background-color: #007bff !important;
        }
        .btn-delete {
            background-color: #dc3545 !important;
        }
        .signup-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            position: relative;
        }
        .form-group input {
            width: 100%;
            padding-right: 40px;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            outline: none;
        }
        .toggle-password:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        .toggle-password svg {
            width: 24px;
            height: 24px;
            color: #6c757d;
            transition: opacity 0.3s ease, transform 0.3s ease;
            position: absolute;
            border: none;
            top: -12px;
            right: 0px;
        }
        .toggle-password .hidden {
            opacity: 0;
            transform: scale(0.5);
        }
        .toggle-password .visible {
            opacity: 1;
            transform: scale(1);
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .menu-container {
                flex-direction: column;
                align-items: flex-start;
            }
            .menu-container nav {
                flex-direction: row;
                width: 100%;
            }
            .menu-container nav button {
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
            }
            .user-item {
                flex-direction: column;
                text-align: center;
            }
            .email-container {
                margin-top: 10px;
                justify-content: center;
                gap: 5px;
            }
            .btn-edit, .btn-delete {
                padding: 0.25rem 0.5rem;
                font-size: 0.9em;
            }
        }

        @media (max-width: 576px) {
            .user-list {
                margin-top: 80px;
                padding: 10px;
            }
            .user-item p {
                font-size: 0.9em;
            }
            .btn-edit, .btn-delete {
                padding: 0.25rem 0.3rem;
                font-size: 0.8em;
            }
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <a href="<?=base_url('login') ?>">
            <h1>LOGO</h1>
        </a>        
        <nav>
            <button type="button" data-toggle="modal" data-target="#userModal">Usuário</button>
            <button type="button" data-toggle="modal" data-target="#editModal">Editar</button>
            <button type="button" data-toggle="modal" data-target="#aboutModal">Sobre</button>
            <button type="button" data-toggle="modal" data-target="#contactModal">Contato</button>
        </nav>
    </div>

    <div class="container user-list">
        <div class="header">
            <h2>Lista de Usuários</h2>
            <button type="button" data-toggle="modal" data-target="#userAddModal">               
                <img src="/codeigniter4-framework-be27314/public/img/plus-icon.png" alt="Add">                
            </button>
        </div>
        <?php if (!empty($users)) : ?>
            <?php foreach ($users as $user) : ?>
                <div class="user-item">
                    <p><strong>Id:</strong> <?= esc($user['id']) ?></p>
                    <p><strong>Nome:</strong> <?= esc($user['name']) ?></p>
                    <p><strong>Telefone:</strong> <?= esc($user['phone']) ?></p>
                    <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                <div class="btn-container">
                    <button type="button" class="btn-edit" data-toggle="modal" data-target="#editUserModal"
                            data-id="<?= esc($user['id']) ?>"
                            data-name="<?= esc($user['name']) ?>"
                            data-phone="<?= esc($user['phone']) ?>"
                            data-email="<?= esc($user['email']) ?>">
                        Edit
                    </button>
                    <form action="<?= base_url('user/delete/' . esc($user['id'])) ?>" method="post" style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                    </form>

                </div>
            </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Nenhum usuário encontrado.</p>
        <?php endif; ?>
    </div>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- About Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aboutModalLabel">Sobre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="userAddModal" tabindex="-1" role="dialog" aria-labelledby="userAddModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userAddModalLabel" style="color: #007bff">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="signup-container">
                    <form action="<?= base_url('signup/register') ?>" method="post">                        
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <button type="button" id="toggleEye" class="toggle-password focus:outline-none">
                                <svg id="eyeOpen" class="hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" />
                                </svg>
                                <svg id="eyeClosed" class="visible" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12s2-5 9-5 9 5 9 5-2 5-9 5-9-5-9-5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h.01M9 12h.01M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        <input type="hidden" name="redirect" value="menu">
                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel" style="color: #007bff">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="<?= base_url('user/update') ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" id="editUserId">
                            <div class="form-group">
                                <input type="text" name="name" id="editName" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" id="editPhone" class="form-control" placeholder="Phone" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="editEmail" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="editPassword" class="form-control" placeholder="Password">
                                <button type="button" id="editToggleEye" class="toggle-password focus:outline-none">
                                    <svg id="editEyeOpen" class="hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" />
                                    </svg>
                                    <svg id="editEyeClosed" class="visible" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12s2-5 9-5 9 5 9 5-2 5-9 5-9-5-9-5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h.01M9 12h.01M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const toggleEye = document.getElementById('toggleEye');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');
        const passwordInput = document.getElementById('password');

        toggleEye.addEventListener('click', () => {
            if (eyeOpen.classList.contains('visible')) {
                eyeOpen.classList.remove('visible');
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
                eyeClosed.classList.add('visible');
                passwordInput.type = 'password';
            } else {
                eyeOpen.classList.remove('hidden');
                eyeOpen.classList.add('visible');
                eyeClosed.classList.remove('visible');
                eyeClosed.classList.add('hidden');
                passwordInput.type = 'text';
            }
        });

        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const userPhone = this.getAttribute('data-phone');
                const userEmail = this.getAttribute('data-email');

                document.getElementById('editUserId').value = userId;
                document.getElementById('editName').value = userName;
                document.getElementById('editPhone').value = userPhone;
                document.getElementById('editEmail').value = userEmail;
            });
        });

    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
