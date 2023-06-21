## Recruitment task

### Project requirements

Please create a simple Laravel/Symfony/(Any other framework you like) site where a user will be able to provide his city and country via form and after submission system will display current weather forecast. 
Forecast temperature should be calculated as an average based on different APIs, at least 2 different data sources (ex. API1 will return temperature 25, API2 will return temperature 27 so the result should be (25+27)/2 ie. 26)
Feel free to use https://openweathermap.org/API  and any other API you like.
Few notes:
- please implement proper error handling
- results should be stored in the database
- a simple caching mechanism should be added
- ability to easily add new data sources (how to register them, interfaces etc.)
- clean data separation
- nice to have - latest PHP mechanisms (ex. traits)
Once done, please either pack the whole code or provide a link to a public repository.

### Implementation method

1. API retrieval error handling has been implemented 
2. Results are stored in the DB
3. To limit API requests each query is being cached in the WeatherService 
4. To add new data sources just create your WeatherProvider class that implements WeatherProviderInterface and add it in services.yaml as App\Service\WeatherService argument.
5. If new provider is based on standard web api with GET/JSON you may subclass AbstractWebApiDataClient and retrieve data by providing API URL and JSON data key and use ApiKeyTrait to store and retrieve API key from .env file.
6. WeatherService is using Strategy pattern to easily rotate unlimited data providers.
7. To run the project the API keys must be set in .env file.

There is a lot more that can be done like implementing some fancy frontend templates, more error handling, unit tests.

