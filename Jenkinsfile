pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh "docker-compose build";
                sh "docker-compose up-d";
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
