function toggleForms(formType) {
    const loginContainer = document.getElementById('login-container');
    const signupContainer = document.getElementById('signup-container');
    const forgotPasswordContainer = document.getElementById('forgot-password-container');
    
    loginContainer.style.display = 'none';
    signupContainer.style.display = 'none';
    forgotPasswordContainer.style.display = 'none';
    
    if (formType === 'login') {
        loginContainer.style.display = 'block';
    } else if (formType === 'signup') {
        signupContainer.style.display = 'block';
    } else if (formType === 'forgotPassword') {
        forgotPasswordContainer.style.display = 'block';
    }
}

function showForgotPassword() {
    toggleForms('forgotPassword');
}
