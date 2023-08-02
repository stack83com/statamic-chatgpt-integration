# Statamic ChatGPT Integration

> Streamline your content creation with Statamic's ChatGPT integration. Get intelligent content suggestions, automated content creation, and natural language processing for easier search. Plus, a chatbot for quick answers and access to resources. Try it now and optimize your content writing process!

## Features

Here are some features highlighting the benefits of integrating ChatGPT with Statamic for content creation:

- Intelligent content suggestions
- Automated content creation
- Natural language processing for easier search
- Chatbot for quick answers and access to resources
- Streamlined content creation process
- Cohesive and consistent brand messaging across website
- Saves time and effort in content creation
- Helps optimize content for search engines
- Multilingual support for businesses operating in multiple countries

Integrating ChatGPT with Statamic can help you create high-quality, effective content that resonates with your audience, while streamlining your content creation process and saving you time and effort.

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require stack83com/statamic-chatgpt-integration
```

## How to Use

Here's where you can explain how to use this wonderful addon.

1. Go to [https://platform.openai.com/](https://platform.openai.com/) > Login or Sign Up
2. Go to View API Keys > Create new secret key
3. Extend the .env file and add `OPENAI_API_KEY` and set the secret key
4. Optionally, you can add `OPENAI_MODEL` and set the model (default: `gpt-3.5-turbo`). View a list of the available models [here]([https://platform.openai.com/docs/models])
5. Spin up your Statamic and go to the CP and login
6. Go to Blueprints and add the "Start ChatGPT" fieldset to the preferred section (don't forget to save)
7. Now, you are ready to start ChatGPT while writing articles, have fun!
