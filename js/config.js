const formLoginAluno = document.getElementById("form-login-aluno");
const formLoginInstrutor = document.getElementById("form-login-instrutor");

if (formLoginAluno) {
    formLoginAluno.addEventListener("submit", event => {
        event.preventDefault();
        const form = event.target;

        loginAluno(form.email.value, form.senha.value);
    });
}

if (formLoginInstrutor) {
    formLoginInstrutor.addEventListener("submit", event => {
        event.preventDefault();
        const form = event.target;

        loginInstrutor(form.email.value, form.senha.value);
    });
}

const formCadastroAluno = document.getElementById("form-cadastro-aluno");
const formCadastroInstrutor = document.getElementById("form-cadastro-instrutor");

if (formCadastroAluno) {
    formCadastroAluno.addEventListener("submit", event => {
        event.preventDefault();
        const form = event.target;

        registroAluno(form.nome.value, form.email.value, form.senha.value);
    });
}

if (formCadastroInstrutor) {
    formCadastroInstrutor.addEventListener("submit", event => {
        event.preventDefault();
        const form = event.target;

        registroInstrutor(form.nome.value, form.email.value, form.senha.value, form.especialidade.value);
    });
}