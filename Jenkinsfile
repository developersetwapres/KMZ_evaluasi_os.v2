pipeline {
    agent any

    stages {

        stage('Checkout Source Code') {
            steps {
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                sh '''
                docker build -t laravel-evaluasiosv2:latest .
                '''
            }
        }

        stage('Deploy Container') {
            steps {
                sh '''
                docker compose down
                docker compose up -d --build
                '''
            }
        }

    }

    post {
        success {
            echo '✅ Deploy berhasil'
        }
        failure {
            echo '❌ Deploy gagal, cek console output'
        }
    }
}

