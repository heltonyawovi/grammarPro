1- Make sure you have installed PHP, Python  and Composer on your MAC. For more information about how to install PHP and Python, you can ask ChatGPT or go to these links https://www.geeksforgeeks.org/how-to-install-php-on-macos/  (for PHP) https://www.dataquest.io/blog/installing-python-on-mac/ (For Python) https://tecadmin.net/install-composer-on-macos/ (for composer)

NB: When you get any error during the following steps, please copy the error and paste in ChatGPT to get the way of solving it.

2 - Open your terminal and enter these commands one after the other

	cd “path-to-grammarPro-folder-you-dowloaded/“
	composer install

	php artisan key:generate

	php artisan serve

// This last command will start the PHP Laravel server. Laravel is a php framework that makes PHP development faster.


3 - Open Finder and go tho the file /path-to-grammarPro-folder-you-dowloaded/public/api/python/llm.py and change at line 39 “YOUR_API_KEY_HERE” with your ChatGPT API Key (os.environ["OPENAI_API_KEY"] = "YOUR_API_KEY_HERE")

4 - Open a new terminal and enter these commands one after the other

pip install Flask

pip install langchain & pip install openai & pip install faiss-cpu & pip install tiktoken

brew install xquartz --cask
brew install poppler antiword unrtf tesseract swig
pip install textract

flask run

// This last command will start the Flask server. Flask is a python framework that helps deploying python scripts as servers.
5 - Open your browser and go to http://127.0.0.1:8000/ or http://localhost:8000/ 
