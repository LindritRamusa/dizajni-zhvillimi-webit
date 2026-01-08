function showError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    const inputElement = document.getElementById(elementId.replace('Error', ''));
    
    if (errorElement) {
        errorElement.textContent = message;
    }
    
    if (inputElement) {
        inputElement.classList.add('error');
    }
}

function clearError(elementId) {
    const errorElement = document.getElementById(elementId);
    const inputElement = document.getElementById(elementId.replace('Error', ''));
    
    if (errorElement) {
        errorElement.textContent = '';
    }
    
    if (inputElement) {
        inputElement.classList.remove('error');
    }
}

function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePhone(phone) {
    const phoneRegex = /^(\+383|0)[4-9]\d{7,8}$/;
    return phoneRegex.test(phone.replace(/\s/g, ''));
}

function validatePassword(password) {
    return password.length >= 8;
}

function validateName(name) {
    return name.trim().length >= 2 && /^[a-zA-ZëËçÇ\s]+$/.test(name);
}

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        const emailInput = document.getElementById('loginEmail');
        const passwordInput = document.getElementById('loginPassword');

        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (email === '') {
                    showError('loginEmailError', 'Email është i detyrueshëm');
                } else if (!validateEmail(email)) {
                    showError('loginEmailError', 'Email nuk është i vlefshëm');
                } else {
                    clearError('loginEmailError');
                }
            });

            emailInput.addEventListener('input', function() {
                if (this.value.trim() !== '' && validateEmail(this.value.trim())) {
                    clearError('loginEmailError');
                }
            });
        }

        if (passwordInput) {
            passwordInput.addEventListener('blur', function() {
                const password = this.value;
                if (password === '') {
                    showError('loginPasswordError', 'Fjalëkalimi është i detyrueshëm');
                } else {
                    clearError('loginPasswordError');
                }
            });

            passwordInput.addEventListener('input', function() {
                if (this.value !== '') {
                    clearError('loginPasswordError');
                }
            });
        }

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            const email = emailInput.value.trim();
            const password = passwordInput.value;

            if (email === '') {
                showError('loginEmailError', 'Email është i detyrueshëm');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError('loginEmailError', 'Email nuk është i vlefshëm');
                isValid = false;
            } else {
                clearError('loginEmailError');
            }

            if (password === '') {
                showError('loginPasswordError', 'Fjalëkalimi është i detyrueshëm');
                isValid = false;
            } else {
                clearError('loginPasswordError');
            }

            if (isValid) {
                console.log('Formulari është i vlefshëm');
            }
        });
    }

    const registerForm = document.getElementById('registerForm');
    
    if (registerForm) {
        const nameInput = document.getElementById('registerName');
        const emailInput = document.getElementById('registerEmail');
        const phoneInput = document.getElementById('registerPhone');
        const passwordInput = document.getElementById('registerPassword');
        const confirmPasswordInput = document.getElementById('registerConfirmPassword');
        const agreeTermsInput = document.getElementById('agreeTerms');

        if (nameInput) {
            nameInput.addEventListener('blur', function() {
                const name = this.value.trim();
                if (name === '') {
                    showError('registerNameError', 'Emri është i detyrueshëm');
                } else if (!validateName(name)) {
                    showError('registerNameError', 'Emri duhet të përmbajë të paktën 2 karaktere dhe vetëm shkronja');
                } else {
                    clearError('registerNameError');
                }
            });
        }

        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (email === '') {
                    showError('registerEmailError', 'Email është i detyrueshëm');
                } else if (!validateEmail(email)) {
                    showError('registerEmailError', 'Email nuk është i vlefshëm');
                } else {
                    clearError('registerEmailError');
                }
            });
        }

        if (phoneInput) {
            phoneInput.addEventListener('blur', function() {
                const phone = this.value.trim();
                if (phone === '') {
                    showError('registerPhoneError', 'Telefoni është i detyrueshëm');
                } else if (!validatePhone(phone)) {
                    showError('registerPhoneError', 'Numri i telefonit nuk është i vlefshëm (formati: +383 49 XXX XXX)');
                } else {
                    clearError('registerPhoneError');
                }
            });
        }

        if (passwordInput) {
            passwordInput.addEventListener('blur', function() {
                const password = this.value;
                if (password === '') {
                    showError('registerPasswordError', 'Fjalëkalimi është i detyrueshëm');
                } else if (!validatePassword(password)) {
                    showError('registerPasswordError', 'Fjalëkalimi duhet të ketë të paktën 8 karaktere');
                } else {
                    clearError('registerPasswordError');
                }
            });

            if (confirmPasswordInput) {
                confirmPasswordInput.addEventListener('blur', function() {
                    const password = passwordInput.value;
                    const confirmPassword = this.value;
                    if (confirmPassword === '') {
                        showError('registerConfirmPasswordError', 'Ju lutem konfirmoni fjalëkalimin');
                    } else if (password !== confirmPassword) {
                        showError('registerConfirmPasswordError', 'Fjalëkalimet nuk përputhen');
                    } else {
                        clearError('registerConfirmPasswordError');
                    }
                });
            }
        }

        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const phone = phoneInput.value.trim();
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            const agreeTerms = agreeTermsInput.checked;

            if (name === '') {
                showError('registerNameError', 'Emri është i detyrueshëm');
                isValid = false;
            } else if (!validateName(name)) {
                showError('registerNameError', 'Emri duhet të përmbajë të paktën 2 karaktere dhe vetëm shkronja');
                isValid = false;
            } else {
                clearError('registerNameError');
            }

            if (email === '') {
                showError('registerEmailError', 'Email është i detyrueshëm');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError('registerEmailError', 'Email nuk është i vlefshëm');
                isValid = false;
            } else {
                clearError('registerEmailError');
            }

            if (phone === '') {
                showError('registerPhoneError', 'Telefoni është i detyrueshëm');
                isValid = false;
            } else if (!validatePhone(phone)) {
                showError('registerPhoneError', 'Numri i telefonit nuk është i vlefshëm');
                isValid = false;
            } else {
                clearError('registerPhoneError');
            }

            if (password === '') {
                showError('registerPasswordError', 'Fjalëkalimi është i detyrueshëm');
                isValid = false;
            } else if (!validatePassword(password)) {
                showError('registerPasswordError', 'Fjalëkalimi duhet të ketë të paktën 8 karaktere');
                isValid = false;
            } else {
                clearError('registerPasswordError');
            }

            if (confirmPassword === '') {
                showError('registerConfirmPasswordError', 'Ju lutem konfirmoni fjalëkalimin');
                isValid = false;
            } else if (password !== confirmPassword) {
                showError('registerConfirmPasswordError', 'Fjalëkalimet nuk përputhen');
                isValid = false;
            } else {
                clearError('registerConfirmPasswordError');
            }

            if (!agreeTerms) {
                showError('agreeTermsError', 'Ju duhet të pranoni kushtet dhe rregullat');
                isValid = false;
            } else {
                clearError('agreeTermsError');
            }

            if (isValid) {
                console.log('Formulari është i vlefshëm');
            }
        });
    }

    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        const nameInput = document.getElementById('contactName');
        const emailInput = document.getElementById('contactEmail');
        const phoneInput = document.getElementById('contactPhone');
        const subjectInput = document.getElementById('contactSubject');
        const messageInput = document.getElementById('contactMessage');

        if (nameInput) {
            nameInput.addEventListener('blur', function() {
                const name = this.value.trim();
                if (name === '') {
                    showError('contactNameError', 'Emri është i detyrueshëm');
                } else if (!validateName(name)) {
                    showError('contactNameError', 'Emri duhet të përmbajë të paktën 2 karaktere');
                } else {
                    clearError('contactNameError');
                }
            });
        }

        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (email === '') {
                    showError('contactEmailError', 'Email është i detyrueshëm');
                } else if (!validateEmail(email)) {
                    showError('contactEmailError', 'Email nuk është i vlefshëm');
                } else {
                    clearError('contactEmailError');
                }
            });
        }

        if (phoneInput) {
            phoneInput.addEventListener('blur', function() {
                const phone = this.value.trim();
                if (phone === '') {
                    showError('contactPhoneError', 'Telefoni është i detyrueshëm');
                } else if (!validatePhone(phone)) {
                    showError('contactPhoneError', 'Numri i telefonit nuk është i vlefshëm');
                } else {
                    clearError('contactPhoneError');
                }
            });
        }

        if (subjectInput) {
            subjectInput.addEventListener('change', function() {
                if (this.value === '') {
                    showError('contactSubjectError', 'Ju lutem zgjidhni temën');
                } else {
                    clearError('contactSubjectError');
                }
            });
        }

        if (messageInput) {
            messageInput.addEventListener('blur', function() {
                const message = this.value.trim();
                if (message === '') {
                    showError('contactMessageError', 'Mesazhi është i detyrueshëm');
                } else if (message.length < 10) {
                    showError('contactMessageError', 'Mesazhi duhet të ketë të paktën 10 karaktere');
                } else {
                    clearError('contactMessageError');
                }
            });
        }

        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const phone = phoneInput.value.trim();
            const subject = subjectInput.value;
            const message = messageInput.value.trim();

            if (name === '') {
                showError('contactNameError', 'Emri është i detyrueshëm');
                isValid = false;
            } else if (!validateName(name)) {
                showError('contactNameError', 'Emri duhet të përmbajë të paktën 2 karaktere');
                isValid = false;
            } else {
                clearError('contactNameError');
            }

            if (email === '') {
                showError('contactEmailError', 'Email është i detyrueshëm');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError('contactEmailError', 'Email nuk është i vlefshëm');
                isValid = false;
            } else {
                clearError('contactEmailError');
            }

            if (phone === '') {
                showError('contactPhoneError', 'Telefoni është i detyrueshëm');
                isValid = false;
            } else if (!validatePhone(phone)) {
                showError('contactPhoneError', 'Numri i telefonit nuk është i vlefshëm');
                isValid = false;
            } else {
                clearError('contactPhoneError');
            }

            if (subject === '') {
                showError('contactSubjectError', 'Ju lutem zgjidhni temën');
                isValid = false;
            } else {
                clearError('contactSubjectError');
            }

            if (message === '') {
                showError('contactMessageError', 'Mesazhi është i detyrueshëm');
                isValid = false;
            } else if (message.length < 10) {
                showError('contactMessageError', 'Mesazhi duhet të ketë të paktën 10 karaktere');
                isValid = false;
            } else {
                clearError('contactMessageError');
            }

            if (isValid) {
                console.log('Mesazhi juaj është dërguar me sukses');
                contactForm.reset();
            }
        });
    }
});

