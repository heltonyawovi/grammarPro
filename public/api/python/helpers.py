from urllib.parse import parse_qs

def httpGetParamsToList(params:str):
    # Example string in HTTP GET parameter format
    # params = 'param1=value1&param2=value2&param3=value3'

    # Decode the string into a dictionary
    param_dict = parse_qs(params)

    # Convert the dictionary values into lists
    param_array = {key: values[0] if len(values) == 1 else values for key, values in param_dict.items()}

    # Print the resulting array
    print(param_array)

    return param_array