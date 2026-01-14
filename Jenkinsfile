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

        stage('Deploy (Restart Container)') {
            steps {
                sh '''
                cd /data/projects/laravel-evaluasiosv2
                docker compose down
                docker compose up -d
                '''
            }
        }
    }
}
