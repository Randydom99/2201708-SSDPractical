pipeline {

    agent any

    environment {
        // Define any environment variables you need
    }

    stages {
        stage('Checkout') {
            steps {
                // Checkout the code from the Git repository
                git 'https://github.com/Randydom99/2201708-SSDPractical.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                // Install PHP dependencies using Composer
                sh 'composer install'
                // If using npm or yarn for frontend dependencies
                // sh 'npm install' or sh 'yarn install'
            }
        }

        stage('Run Unit Tests') {
            steps {
                // Run your PHP unit tests using PHPUnit
                sh './vendor/bin/phpunit'
                // If you have JavaScript tests
                // sh 'npm test' or sh 'yarn test'
            }
        }

        stage('Run Integration Tests') {
            steps {
                // Run integration tests
                // You can use tools like Behat for PHP or custom scripts
                // sh './vendor/bin/behat'
            }
        }

        stage('Dependency Check') {
            steps {
                // Perform a dependency check
                // You can use tools like OWASP Dependency Check or Composer Audit
                sh 'composer audit'
            }
        }

        stage('UI Testing') {
            steps {
                // Run UI tests using a tool like Selenium
                // Ensure you have a Selenium server running or use a cloud service
                sh 'php artisan dusk'
                // or
                // sh 'npm run cypress'
            }
        }

        stage('Deploy to Test Environment') {
            steps {
                // Deploy the application to a test environment
                // This could involve copying files to a server, running Docker, etc.
                // Example: scp -r * user@yourserver:/path/to/deploy
            }
        }

        stage('UI Tests over HTTP') {
            steps {
                // Run UI tests over HTTP
                // Ensure the web application is accessible and run your tests
                // Example using curl to check the homepage
                sh 'curl -I http://your-web-app-url'
            }
        }
    }

    post {
        always {
            // Clean up workspace or send notifications
            cleanWs()
        }
        success {
            // Actions on successful build
            echo 'Build succeeded!'
        }
        failure {
            // Actions on failed build
            echo 'Build failed!'
        }
    }
}

  environment {
    registry = "bkshashi9/webapp"
    registryCredential = 'dockerhub'
    dockerImage = ''

  }
  agent any
  stages {
    stage('Cloning Git') {
      steps {
        git 'ssh://git@18.139.110.189:2222/git-server/repos/webapp.git'
      }
    }
    stage('Building Docker image') {
      steps{
        script {
          dockerImage = docker.build registry + ":$BUILD_NUMBER"
          
        }
      }
    }
    stage('Push Image to Docker Hub ') {
      steps{
        script {
          docker.withRegistry( '', registryCredential ) {
            dockerImage.push()
            dockerImage.push('latest')
          }
        }
      }
    }


stage ('Deploy') {
    steps{
        sshagent(credentials : ['ubuntu']) {
            sh 'docker pull bkshashi9/webapp:latest'
            sh 'docker stop webapp'
            sh 'docker rm webapp'
            sh 'docker rmi bkshashi9/webapp:current || true'
            sh 'docker tag bkshashi9/webapp:latest bkshashi9/webapp:current'
            sh 'docker run -d --name webapp -p 8082:80 bkshashi9/webapp:latest'
        }
    }
}

stage('Remove Unused docker image') {
      steps{
sshagent(credentials : ['ubuntu']) {       
 sh "docker rmi $registry:$BUILD_NUMBER"
      }
}
    }

      
    }

   
  }
