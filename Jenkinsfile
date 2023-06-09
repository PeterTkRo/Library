pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh "docker-compose buyild";
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}
