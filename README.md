## ScreenShot of this app :
![ScreenShot of this app](/screenshots/screenshot-full-GrammarPro.png)

## How to install and use this project :

After downloading this repository and extracting it, please rename from "grammarPro-main"  to "grammarPro".

1- Make sure you have installed PHP, Python  and Composer on your MAC. For more information about how to install PHP, Composer and Python, you can ask ChatGPT or go to these links https://www.geeksforgeeks.org/how-to-install-php-on-macos/  (for PHP) https://www.dataquest.io/blog/installing-python-on-mac/ (For Python) https://tecadmin.net/install-composer-on-macos/ (for composer)

NB: When you get any error during the following steps, please copy the error and paste in ChatGPT to get the way of solving it.

2 - Open your terminal and enter these commands one after the other:

	cd "path-to-grammarPro-folder-you-dowloaded/"
	
    composer install

    cp .env.example .env

	php artisan key:generate

	php artisan serve


This last command "php artisan serve" will start the PHP Laravel server. Laravel is a php framework that makes PHP development faster.


3 - Open Finder on your MAC and go tho the file "/path-to-grammarPro-folder-you-dowloaded/public/api/python/llm.py" and change at line 39  “YOUR_API_KEY_HERE” with your ChatGPT API Key (os.environ["OPENAI_API_KEY"] = "YOUR_API_KEY_HERE")

4 - Open a new terminal and enter these commands one after the other:

    pip install Flask

    pip install langchain & pip install openai & pip install faiss-cpu & pip install tiktoken

    brew install xquartz --cask

    brew install poppler antiword unrtf tesseract swig

    pip install textract

    cd "path-to-grammarPro-folder-you-dowloaded/public/api/python/"

    export FLASK_ENV=development

    flask run

This last command "flask run" will start the Flask server. Flask is a python framework that helps deploying python scripts as servers.

5 - Open your browser and go to http://127.0.0.1:8000/ or http://localhost:8000/ 

6 - If you get any error alert or popup while using the app, check in your terminal where you launched the flask server. You will get more information about the origin of the error. You may encounter "openai.error.AuthenticationError" error. For this error please check if your API key is correct and exists here : https://platform.openai.com/account/api-keys 
