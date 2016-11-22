// chamda do module
angular.module('app.controllers')
    .controller('HomeController', ['$scope', '$cookies', '$timeout', '$pusher', 'Projeto', function ($scope, $cookies, $timeout, $pusher, Projeto) {
        Projeto.query({
            orderBy: 'created_at',
            sortedBy: 'desc',
            limit: 6
        }, function (response) {
            $scope.projetos = response.data;
        });

        $scope.tasks = [];

        function updateListTask(data) {
            if ($scope.tasks.length > 6) {
                $scope.tasks.splice($scope.tasks.length - 1, 1);
            }

            $timeout(function () {
                var task = data.task;
                task['projeto'] = {data: data.projeto}
                $scope.tasks.unshift(task);
            }, 1000)
        }

        var pusher = $pusher(window.client);
        var channel = pusher.subscribe('user.' + $cookies.getObject('user').id);

        channel.bind('projetoModuloLaravel\\Events\\TaskWasIncluded',
            function (data) {
                data['task']['action_event'] = "Nova Tarefa Incluída";
                updateListTask(data);
            }
        );

        channel.bind('projetoModuloLaravel\\Events\\TaskWasUpdated',
            function (data) {
                data['task']['action_event'] = "Tarefa Atualizada";
                updateListTask(data);
            }
        );

    }]);