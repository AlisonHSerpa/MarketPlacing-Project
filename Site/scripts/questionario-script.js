let currentQuestion = 0;
const answers = [];

const questions = [
    "Com que frequência você deixa um projeto pela metade depois de já ter feito as partes mais dificeis?",
    "Com que frequência você tem dificuldade para fazer um trabalho que exige organização?",
    "Com que frequência você tem dificuldade para lembrar de compromissos ou obrigações?",
    "Quando você precisa fazer algo que exige muita concentração, com que frequência você evita ou adia o inicio?",
    "Com que frequência você fica se mexendo na cadeira ou balançando as mãos e pés quando precisa ficar sentado(a) por muito tempo?",
    "Com que frequência você se sente ativo(a) demais e necessitando fazer coisas, como se estivesse ''com um motor ligado''?",
    "Com que frequência você comete erros bobos por falta de atenção quando tem de trabalhar num projeto chato ou dificil?",
    "Com que frequência você tem dificuldade para manter a atenção quando está fazendo um trabalho chato ou repetitivo?",
    "Com que frequência você tem dificuldade para se concetrar no que as pessoas dizem, mesmo quando elas estão falando diretamente com você?",
    "Com que frequência você coloca as coisas fora do lugar ou tem dificuldade de encontrar as coisas em casa ou no trabalho?",
    "Com que frequência você se distrai com atividades ou barulho a sua volta?",
    "Com que frequência você se levanta da cadeira em reuniões ou em outras situações onde deveria ficar sentado(a)?",
    "Com que frequência você se sente inquieto(a) ou agitado(a)?",
    "Com que frequência você tem dificuldade para sossegar e relaxar quando tem tempo livre para você?",
    "Com que frequência você se pega falando demais em situações sociais?",
    "Quando você está conversando, com que frequência você se pega terminando as frases das pessoas antes delas?",
    "Com que frequência você tem dificuldade para esperar nas situações onda cada um tem sua vez?",
    "Com que frequência você interrompe os outros quando eles estão ocupados?"
];

function showQuestion(index) {
    document.getElementById('question').textContent = questions[index];
    document.querySelector('form').reset(); // Reinicia os botões
}

function submitAnswer(value) {
    answers[currentQuestion] = value;
    currentQuestion++;
    if (currentQuestion < questions.length) {
        showQuestion(currentQuestion);
    } else {
        document.getElementById('question').textContent = "Questionário concluído!";
        document.getElementById('buttons').style.display = 'none';
        document.getElementById('submit').style.display = 'block';
    }
}

function sendData() {
    const form = document.createElement('form');
    form.method = 'post';
    form.action = '../paginas/processa-respostas.php';

    answers.forEach((answer, index) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `resposta${index + 1}`;
        input.value = answer;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

window.onload = () => showQuestion(currentQuestion);
