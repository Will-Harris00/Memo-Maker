import pandas as pd

df = pd.read_excel('tolist.xlsx')
df.columns = ['Name']
coloursList = df['Name'].to_list()
print(coloursList)
