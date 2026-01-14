pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t laravel-evaluasiosv2:latest .'
            }
        }

        stage('Deploy Container') {
            steps {
                sh '''
                docker compose down
                docker compose up -d
                '''
            }
        }
    }
}
o

