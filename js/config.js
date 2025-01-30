const formLoginAluno = document.getElementById("form-login-aluno");
const formLoginInstrutor = document.getElementById("form-login-instrutor");

if (formLoginAluno) {
    formLoginAluno.addEventListener("submit", event => {
        event.preventDefault();
        const form = event.target;

        loginAluno(form.email.value, form.senha.value);
    });
}