// --- Toggle visibilità password ---
const togglePasswordBtn = document.querySelector('#togglePassword');
const passwordInput = document.querySelector('#id_password');

togglePasswordBtn.addEventListener('click', () => {
  const isPassword = passwordInput.type === 'password';
  passwordInput.type = isPassword ? 'text' : 'password';
  togglePasswordBtn.classList.toggle('fa-eye-slash');
});

// --- Navigazione al registro ---
const btnRegister = document.querySelector("#btn_reg");

btnRegister.addEventListener('click', () => {
  location.href = "register";
});
