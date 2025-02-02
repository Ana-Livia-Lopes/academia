function erroExterno(resp) {
    Swal.fire({
        icon: "warning",
        title: "Erro externo",
        text: "Consulte os administradores do site para saber mais.\n" + `[${resp}]`
    });
}

function tryJSON(resp) {
    if (resp.headers.get("content-type")?.includes("application/json")) {
        return resp.json();
    } else {
        return resp.text();
    }
}

async function registroAluno(nome, email, senha, cpf, endereco, telefone) {
    const post = new FormData();

    if (nome) post.append("nome", nome);
    if (email) post.append("email", email);
    if (senha) post.append("senha", senha);
    if (cpf) post.append("cpf", cpf);
    if (endereco) post.append("endereco", endereco);
    if (telefone) post.append("telefone", telefone);

    fetch("./php/registro_aluno.php", {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Registro efetuado",
                    text: resp.mensagem
                }).then(() => {
                    window.location.href = "./index.php";
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro no registro",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function registroInstrutor(nome, email, senha, especialidade) {
    const post = new FormData();

    if (nome) post.append("nome", nome);
    if (email) post.append("email", email);
    if (senha) post.append("senha", senha);
    if (especialidade) post.append("especialidade", especialidade);

    fetch("./php/registro_instrutor.php", {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Registro efetuado",
                    text: resp.mensagem
                }).then(() => {
                    window.location.href = "./index.php";
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro no registro",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function loginAluno(email, senha) {
    const post = new FormData();

    if (email) post.append("email", email);
    if (senha) post.append("senha", senha);

    fetch("./php/login_aluno.php", {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Sessão iniciada",
                    text: resp.mensagem
                }).then(() => {
                    window.location.href = "./index.php";
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na entrada",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function loginInstrutor(email, senha) {
    const post = new FormData();

    if (email) post.append("email", email);
    if (senha) post.append("senha", senha);

    fetch("./php/login_instrutor.php", {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Sessão iniciada",
                    text: resp.mensagem
                }).then(() => {
                    window.location.href = "./index.php";
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na entrada",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function logout() {
    Swal.fire({
        icon: "info",
        title: "Encerrar sessão",
        text: "Realmente deseja encerrar a sessão?",
        showDenyButton: true,
        denyButtonText: "Cancelar",
        confirmButtonText: "Encerrar",
        showCloseButton: true
    }).then(result => {
        if (result.isConfirmed) {
            fetch("./php/logout.php").then(resp => {
                if (resp.ok) {
                    Swal.fire({
                        icon: "success",
                        title: "Sessão encerrada",
                        text: "Você foi desconectado com sucesso."
                    }).then(() => {
                        window.location.href = "./index.php";
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erro na desconexão",
                        text: "Não foi possível desconectar sua sessão."
                    });
                    resp.text().then(text => console.log(text));
                }
            });
        }
    });
}

async function estaLogado() {
    return JSON.parse((await (fetch("./php/checkLogin.php")).then(resp => resp.text())));
}

async function bloquearNaoLogado(callback) {
    if (await estaLogado()) {
        callback();
    } else {
        Swal.fire({
            icon: "error",
            title: "Sessão necessária",
            text: "Inicie uma sessão para acessar esta área"
        });
    }
}

async function checkNivel() {
    return (await (fetch("./php/checkNivel.php")).then(resp => resp.text()));
}

async function crudAluno(action, data, callback) {
    const post = new FormData();
    if (action) post.append("action", action);
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            post.append(key, data[key]);
        }
    }

    fetch(`./php/crud_aluno.php`, {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Edição bem-sucedida",
                    text: resp.mensagem
                }).then(callback);
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na operação",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function crudAula(action, data) {
    const post = new FormData();
    if (action) post.append("action", action);
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            post.append(key, data[key]);
        }
    }

    fetch(`./php/crud_aula.php`, {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Edição bem-sucedida",
                    text: resp.mensagem
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na operação",
                    text: resp.mensagem
                });
            }
        }
    });
}

async function crudInstrutor(action, data) {
    const post = new FormData();
    if (action) post.append("action", action);
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            post.append(key, data[key]);
        }
    }

    fetch(`./php/crud_instrutor.php`, {
        method: "POST",
        body: post
    }).then(resp => tryJSON(resp)).then(resp => {
        if (typeof resp === "string") {
            erroExterno(resp);
        }
        if (typeof resp === "object") {
            if (resp.status === "sucesso") {
                Swal.fire({
                    icon: "success",
                    title: "Edição bem-sucedida",
                    text: resp.mensagem
                });
            }
            if (resp.status === "erro") {
                Swal.fire({
                    icon: "error",
                    title: "Erro na operação",
                    text: resp.mensagem
                });
            }
        }
    });
}

function recarregar() {
    window.location.reload();
}

async function editarAluno(id, callback) {
    Swal.fire({
        title: 'Editar Aluno',
        html: `
            <input id="swal-input1" class="swal2-input custom-swal-default-width" placeholder="Nome">
            <input id="swal-input2" class="swal2-input custom-swal-default-width" placeholder="Endereço">
            <input id="swal-input3" class="swal2-input custom-swal-default-width" placeholder="Telefone">
            <style>
            .custom-swal-default-width {
                width: 60%;
            }
            </style>
        `,
        focusConfirm: false,
        confirmButtonText: "Alterar",
        showCloseButton: true,
        showDenyButton: true,
        denyButtonText: "Cancelar",
        preConfirm: () => {
            const values = {
                nome: document.getElementById('swal-input1').value,
                endereco: document.getElementById('swal-input2').value,
                telefone: document.getElementById('swal-input3').value
            }
            for (const [ key, value ] of Object.entries(values)) {
                if (!value) delete values[key]
            }
            return values;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            if (Object.values(result.value).length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Editando aluno...",
                    text: "Nenhuma informação foi alterada."
                });
            } else {
                Swal.fire({
                    title: "Editando aluno...",
                    icon: "question",
                    html: `
                        <h3>Informações a serem alteradas:</h3>
                        ${result.value.nome ? "<p><b>Nome:</b> " + result.value.nome + "</p>" : ""}
                        ${result.value.endereco ? "<p><b>Endereço:<b/> " + result.value.endereco + "</p>" : ""}
                        ${result.value.telefone ? "<p><b>Telefone:</b> " + result.value.telefone + "</p>" : ""}
                    `,
                    focusConfirm: false,
                    confirmButtonText: "Confirmar",
                    denyButtonText: "Cancelar",
                    showDenyButton: true,
                    showCloseButton: true
                }).then(() => {
                    crudAluno("update", { id, ...result.value}, callback);
                });
            }
        }
    });
}

async function editarInstrutor(id, callback) {
    Swal.fire({
        title: 'Editar Instrutor',
        html: `
            <input id="swal-input1" class="swal2-input custom-swal-default-width" placeholder="Nome">
            <select id="swal-input2" class="swal2-input custom-swal-select custom-swal-default-width">
                <option value="" selected>Especialidade</option>
                <option value="Pilates">Pilates</option>
                <option value="Crossfit">Crossfit</option>
                <option value="Musculação">Musculação</option>
                <option value="Yoga">Yoga</option>
                <option value="Aeróbica">Aeróbica</option>
                <option value="Ginástica">Ginástica</option>
                <option value="Alongamento">Alongamento</option>
                <option value="Luta">Luta</option>
            </select>
            <style>
            .custom-swal-default-width {
                width: 60%;
            }
            .custom-swal-select {
                margin-top: 1rem;
                height: 2.625em;
                padding: 0 .75em;
                box-sizing: border-box;
                transition: border-color .1s, box-shadow .1s;
                border: 1px solid #d9d9d9;
                border-radius: .1875em;
                background: rgba(0, 0, 0, 0);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(0, 0, 0, 0);
                color: inherit;
                font-size: 1.125em;
            }
            </style>
        `,
        focusConfirm: false,
        confirmButtonText: "Alterar",
        showCloseButton: true,
        showDenyButton: true,
        denyButtonText: "Cancelar",
        preConfirm: () => {
            const values = {
                nome: document.getElementById('swal-input1').value,
                especialidade: document.getElementById('swal-input2').value
            }
            for (const [ key, value ] of Object.entries(values)) {
                if (!value) delete values[key]
            }
            return values;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            if (Object.values(result.value).length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Editando instrutor...",
                    text: "Nenhuma informação foi alterada."
                });
            } else {
                Swal.fire({
                    title: "Editando instrutor...",
                    icon: "question",
                    html: `
                        <h3>Informações a serem alteradas:</h3>
                        ${result.value.nome ? "<p><b>Nome:</b> " + result.value.nome + "</p>" : ""}
                        ${result.value.especialidade ? "<p><b>Especialidade:</b> " + result.value.especialidade + "</p>" : ""}
                    `,
                    focusConfirm: false,
                    confirmButtonText: "Confirmar",
                    denyButtonText: "Cancelar",
                    showDenyButton: true,
                    showCloseButton: true
                }).then(() => {
                    crudInstrutor("update", { id, ...result.value });
                    if (callback) callback()
                });
            }
        }
    });
}

async function editarAula(id, callback) {
    Swal.fire({
        title: 'Editar Aula',
        html: `
            <select id="swal-input1" class="swal2-input custom-swal-default-width custom-swal-select">
                <option value="" selected>Dia da Semana</option>
                <option value="Segunda-feira">Segunda-feira</option>
                <option value="Terça-feira">Terça-feira</option>
                <option value="Quarta-feira">Quarta-feira</option>
                <option value="Quinta-feira">Quinta-feira</option>
                <option value="Sexta-feira">Sexta-feira</option>
                <option value="Sábado">Sábado</option>
                <option value="Domingo">Domingo</option>
            </select>
            <select id="swal-input2" class="swal2-input custom-swal-default-width custom-swal-select">
                <option value="" selected>Modalidade</option>
                <option value="Pilates">Pilates</option>
                <option value="Crossfit">Crossfit</option>
                <option value="Musculação">Musculação</option>
                <option value="Yoga">Yoga</option>
                <option value="Aeróbica">Aeróbica</option>
                <option value="Ginástica">Ginástica</option>
                <option value="Alongamento">Alongamento</option>
                <option value="Luta">Luta</option>
            </select>
            <input id="swal-input3" class="swal2-input custom-swal-default-width" placeholder="Email do Instrutor">
            <input id="swal-input4" class="swal2-input custom-swal-default-width" placeholder="Email do Aluno">
            <style>
            .custom-swal-default-width {
                width: 60%;
            }
            .custom-swal-select {
                margin-top: 1rem;
                height: 2.625em;
                padding: 0 .75em;
                box-sizing: border-box;
                transition: border-color .1s, box-shadow .1s;
                border: 1px solid #d9d9d9;
                border-radius: .1875em;
                background: rgba(0, 0, 0, 0);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(0, 0, 0, 0);
                color: inherit;
                font-size: 1.125em;
            }
            </style>
        `,
        focusConfirm: false,
        confirmButtonText: "Alterar",
        showCloseButton: true,
        showDenyButton: true,
        denyButtonText: "Cancelar",
        preConfirm: () => {
            const values = {
                data: document.getElementById('swal-input1').value,
                tipo: document.getElementById('swal-input2').value,
                instrutor: document.getElementById('swal-input3').value,
                aluno: document.getElementById('swal-input4').value
            }
            for (const [ key, value ] of Object.entries(values)) {
                if (!value) delete values[key]
            }
            return values;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            if (Object.values(result.value).length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Editando aula...",
                    text: "Nenhuma informação foi alterada."
                });
            } else {
                Swal.fire({
                    title: "Editando aula...",
                    icon: "question",
                    html: `
                        <h3>Informações a serem alteradas:</h3>
                        ${result.value.data ? "<p><b>Dia da Semana:</b> " + result.value.data + "</p>" : ""}
                        ${result.value.tipo ? "<p><b>Modalidade:</b> " + result.value.tipo + "</p>" : ""}
                        ${result.value.instrutor ? "<p><b>Email do Instrutor:</b> " + result.value.instrutor + "</p>" : ""}
                        ${result.value.aluno ? "<p><b>Email do Aluno:</b> " + result.value.aluno + "</p>" : ""}
                    `,
                    focusConfirm: false,
                    confirmButtonText: "Confirmar",
                    denyButtonText: "Cancelar",
                    showDenyButton: true,
                    showCloseButton: true
                }).then(() => {
                    crudAula("update", { id, ...result.value });
                    if (callback) callback()
                });
            }
        }
    });
}

async function excluirAluno(id, callback) {
    Swal.fire({
        title: "Excluir Aluno",
        icon: "warning",
        html: `
            <h3>Tem certeza que deseja excluir o aluno?</h3>
            <p>Esta ação é irreversível.</p>
        `,
        focusConfirm: false,
        confirmButtonText: "Confirmar",
        denyButtonText: "Cancelar",
        showDenyButton: true,
        showCloseButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            crudAluno("delete", { id }, callback);
        }
    });
}

async function excluirInstrutor(id, callback) {
    Swal.fire({
        title: "Excluir Instrutor",
        icon: "warning",
        html: `
            <h3>Tem certeza que deseja excluir o instrutor?</h3>
            <p>Esta ação é irreversível.</p>
        `,
        focusConfirm: false,
        confirmButtonText: "Confirmar",
        denyButtonText: "Cancelar",
        showDenyButton: true,
        showCloseButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            crudInstrutor("delete", { id }, callback);
        }
    });
}

async function excluirAula(id, callback) {
    Swal.fire({
        title: "Excluir Aula",
        icon: "warning",
        html: `
            <h3>Tem certeza que deseja excluir a aula?</h3>
            <p>Esta ação é irreversível.</p>
        `,
        focusConfirm: false,
        confirmButtonText: "Confirmar",
        denyButtonText: "Cancelar",
        showDenyButton: true,
        showCloseButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            crudAula("delete", { id }, callback);
        }
    });
}



















// em edição, não ta pronto 


async function adcionarAula() {
    Swal.fire({
        title: 'Adcionar aula',
        html: `
        <select id="swal-input1" class="swal2-input custom-swal-default-width custom-swal-select">
            <option value="" selected>Dia da Semana</option>
            <option value="Segunda-feira">Segunda-feira</option>
            <option value="Terça-feira">Terça-feira</option>
            <option value="Quarta-feira">Quarta-feira</option>
            <option value="Quinta-feira">Quinta-feira</option>
            <option value="Sexta-feira">Sexta-feira</option>
            <option value="Sábado">Sábado</option>
            <option value="Domingo">Domingo</option>
        </select>
        <select id="swal-input2" class="swal2-input custom-swal-default-width custom-swal-select">
            <option value="" selected>Modalidade</option>
            <option value="Pilates">Pilates</option>
            <option value="Crossfit">Crossfit</option>
            <option value="Musculação">Musculação</option>
            <option value="Yoga">Yoga</option>
            <option value="Aeróbica">Aeróbica</option>
            <option value="Ginástica">Ginástica</option>
            <option value="Alongamento">Alongamento</option>
            <option value="Luta">Luta</option>
        </select>
        <input id="swal-input3" class="swal2-input custom-swal-default-width" placeholder="Email do Instrutor">
        <input id="swal-input4" class="swal2-input custom-swal-default-width" placeholder="Email do Aluno">
        <style>
        .custom-swal-default-width {
            width: 60%;
        }
        .custom-swal-select {
            margin-top: 1rem;
            height: 2.625em;
            padding: 0 .75em;
            box-sizing: border-box;
            transition: border-color .1s, box-shadow .1s;
            border: 1px solid #d9d9d9;
            border-radius: .1875em;
            background: rgba(0, 0, 0, 0);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(0, 0, 0, 0);
            color: inherit;
            font-size: 1.125em;
        }
        </style>
    `,
        focusConfirm: false,
        confirmButtonText: "Alterar",
        showCloseButton: true,
        showDenyButton: true,
        denyButtonText: "Cancelar",
        preConfirm: () => {
            const values = {
                nome: document.getElementById('swal-input1').value,
                endereco: document.getElementById('swal-input2').value,
                telefone: document.getElementById('swal-input3').value
            }
            for (const [ key, value ] of Object.entries(values)) {
                if (!value) delete values[key]
            }
            return values;
        }
    })
}