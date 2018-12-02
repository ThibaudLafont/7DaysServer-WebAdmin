$(document).ready(function() {
    // Get logs now and every second
    getLogs();
    setInterval(getLogs, 1000);

    // Get state of server and handle display
    serverState();
    setInterval(serverState, 1000);

    // Action buttons handle
    $('#start-button').click(startServer);
    $('#stop-button').click(stopServer);
    $('#reload-button').click(reloadServer);
    $('#update-button').click(updateServer);

    // Scroll logs to bottom by default
    var logsScroll = setInterval(scrollToBottom, 1);
    // On logs action button click, enable or disable auto scroll
    $('#logs-actions button').click(function () {
        // Store icon element
        var icon = document.getElementById('scroll-button-icon');

        // If scroll enabled
        if (icon.classList.contains('glyphicon-pause')) {
            // Stop scrolling to bottom
            clearInterval(logsScroll);
            // Switch pause icon to play icon
            icon.classList.remove('glyphicon-pause')
            icon.classList.add('glyphicon-play')
            // If scroll disabled
        } else if(icon.classList.contains('glyphicon-play')) {
            // Enable bottom scroll
            logsScroll = setInterval(scrollToBottom, 1);
            // Switch play button to pause button
            icon.classList.remove('glyphicon-play')
            icon.classList.add('glyphicon-pause')
        }
    });
});

// Logs get
function getLogs(){
    $.get(
        "/get-logs",
        function(data) {
            // Store current log file name and actual content
            var currentFileName = $('#current-log-file').text();

            // If first call or different file
            if(currentFileName === '' || currentFileName != data['path']) {
                // Inquire file name
                $('#current-log-file').text(data['path']);
                // Inject all content
                var injects = data['logs'];
                // Store actual file content in DOM
                $('#actual-file-content').text(data['logs'])

            // If same file
            } else if (currentFileName == data['path']) {
                // Get actual file log content
                var actualContent = $('#actual-file-content').text().split('\n');

                // If data length > actual
                if(actualContent.length < (data['logs'].length +1)) {
                    // Extract new lines
                    var newLinesCount = (data['logs'].length+1) - actualContent.length;
                    var injects = data['logs'].slice(-newLinesCount)
                    // Store actual file content in DOM
                    $('#actual-file-content').text(data['logs'])
                } else {
                    var injects = [];
                }
            }

            // Append all injects
            injects.forEach(function(e){
                var p = document.createElement('p');
                p.textContent = e;
                $('#logs-output').append(p);
            });
        }
    ).fail(function() {
        var alertEl = document.getElementById('error-server-logs-alert');
        alertEl.textContent = 'Récupération des logs impossible ou erreur d\'éxecution';
        alertEl.style.display = 'block';
    })
}

// Scroll to logs div bottom
function scrollToBottom() {
    var element = $('#logs-output');
    element.scrollTop(element.prop('scrollHeight'));
}

function serverState(){
    $.get(
        '/server-state',
        function(response) {
            // Store elements
            var span = document.getElementById('server-state');
            var startButton = document.getElementById('start-button');
            var stopButton = document.getElementById('stop-button');

            // If started
            if(response) {
                // If state is not good one
                if(span.textContent == 'État : Stoppé') {
                    // Toggle state
                    span.textContent = 'État : Démarré';
                    span.classList.remove('label-danger');
                    span.classList.add('label-success');
                }
                // If start button not displayed
                // if(getComputedStyle(stopButton, null).display == 'none') {
                //     stopButton.style.display = 'inline-block'
                // }
                // // If stop button is display
                // if(getComputedStyle(startButton, null).display == 'inline-block') {
                //     startButton.style.display = 'none'
                // }
            } else {
                // If state is not good one
                if(span.textContent == 'État : Démarré') {
                    // Toggle state
                    span.textContent = 'État : Stoppé';
                    span.classList.remove('label-danger');
                    span.classList.add('label-success');
                }
                // // If start button is not show
                // if(getComputedStyle(startButton, null).display == 'none') {
                //     startButton.style.display = 'inline-block'
                // }
                // // If stop button is display
                // if(getComputedStyle(stopButton, null).display == 'inline-block') {
                //     stopButton.style.display = 'none'
                // }
            }
        }
    ).fail(function() {
        var alertEl = document.getElementById('error-server-state-alert');
        alertEl.textContent = 'Impossible de récupérer l\'état du serveur';
        alertEl.style.display = 'block';
    })
}

function startServer() {
    $.get(
        '/start-server',
        function(response) {
            // Hide start button
            $('#start-button').hide();
            // Show stop button
            $('#stop-button').show();
        }
    ).fail(function() {
        displayError('Démarrage impossible ou erreur d\'éxecution')
    })
}

function stopServer() {
    $.get(
        '/stop-server',
        function(response) {
            // Hide start button
            $('#stop-button').hide();
            // Show stop button
            $('#start-button').show();
        }
    ).fail(function() {
        displayError('Arrêt impossible ou erreur d\'éxecution')
    })
}

function reloadServer() {
    $.get(
        '/reload-server',
        function(response) {
            console.log('Serveur reloadé')
        }
    ).fail(function() {
        displayError('Reload impossible ou erreur d\'éxecution')
    })
}
function updateServer() {
    $.get(
        '/update-server',
        function(response) {
            console.log('Serveur mis à jour')
        }
    ).fail(function() {
        displayError('Mise à jour impossible ou erreur d\'éxecution')
    })
}

function displayError(errorMessage) {
    var alertEl = document.getElementById('error-server-alert');
    alertEl.textContent = errorMessage;
    alertEl.style.display = 'block';
}