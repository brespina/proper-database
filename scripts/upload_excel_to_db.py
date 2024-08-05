import sys
import json
from utils import create_engine_from_config, upload_to_database

config_file = '../config/config.json'

def main():
    if len(sys.argv) != 2:
        print("Usage: python upload_excel_to_db.py <path_to_excel_file>")
        sys.exit(1)

    file_path = sys.argv[1]

    with open(config_file) as f:
        config = json.load(f)

    db_config = config['db']

    engine = create_engine_from_config(db_config)
    upload_to_database(file_path, engine)

if __name__ == '__main__':
    main()
