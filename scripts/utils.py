import pandas as pd
from sqlalchemy import create_engine

def create_engine_from_config(db_config):
    db_url = f'postgresql+psycopg2://{db_config["user"]}:{db_config["pass"]}@{db_config["host"]}:{db_config["port"]}/{db_config["dbname"]}'
    return create_engine(db_url)

def upload_to_database(file_path, engine):
    if file_path.endswith('.xlsm'):
        df = pd.read_excel(file_path, engine='openpyxl')
    elif file_path.endswith('.xlsx'):
        df = pd.read_excel(file_path, engine='openpyxl')
    else:
        raise ValueError(f"Unsupported file type: {file_path}")
    
    table_name = file_path.split("\\")[-1].split('.')[0]
    df.to_sql(table_name, engine, if_exists='replace', index=False)
    