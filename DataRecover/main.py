import pandas as pd
import os

dirname = 'lviv'
files = os.listdir(dirname)
print(files)
df = pd.DataFrame()
for file in files:
    xl = pd.ExcelFile(f'{dirname}/{file}')
    df1 = xl.parse()
    df1 = df1.iloc[:, :5]
    df1.insert(0, 'Месяц', [abs(int(file[-7:-5])) for _ in range(len(list(df1['T'])))], True)
    df = pd.concat([df, df1], ignore_index=True)

for key in ['T', 'dd', 'FF']:
    data = list(df[key])
    previous_next = []
    for i in range(len(data)):
        if key == 'FF':
            data[i] = abs(int(data[i]))
        if pd.isna(data[i]):
            previous_next.append(data[i - 1])
            counter = 1
            n = i
            while pd.isna(data[n + 1]):
                counter += 1
                n += 1
            previous_next.append(data[n + 1])
            first_half = counter // 2
            second_half = counter - first_half
            k = i
            for _ in range(first_half):
                data[k] = previous_next[0]
                k += 1
            for _ in range(second_half):
                data[k] = previous_next[1]
                k += 1
            previous_next.clear()
    df[key] = data

df.to_excel('empty.xlsx')
