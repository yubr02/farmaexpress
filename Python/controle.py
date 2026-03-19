from PyQt5 import uic, QtWidgets
from PyQt5.QtWidgets import QMessageBox
import mysql.connector

def limpar_campos():
    formulario.lineEdit.setText("")
    formulario.lineEdit_4.setText("")
    formulario.lineEdit_2.setText("")
    formulario.lineEdit_3.setText("")
    formulario.lineEdit_5.setText("")
    formulario.radioButton.setAutoExclusive(False)
    formulario.radioButton_2.setAutoExclusive(False)
    formulario.radioButton_3.setAutoExclusive(False)
    formulario.radioButton.setChecked(False)
    formulario.radioButton_2.setChecked(False)
    formulario.radioButton_3.setChecked(False)
    formulario.radioButton.setAutoExclusive(True)

def funcao_principal():
    id_produto = formulario.lineEdit.text()
    nome_produto = formulario.lineEdit_4.text()
    descricao = formulario.lineEdit_2.text()
    preco = formulario.lineEdit_3.text()
    imagem = formulario.lineEdit_5.text()

    if formulario.radioButton_3.isChecked():
        categoria = "Remédio"
    elif formulario.radioButton_2.isChecked():
        categoria = "Beleza"
    elif formulario.radioButton.isChecked():
        categoria = "Higiene pessoal"
    else:
        categoria = "Nenhuma categoria selecionada"

    print("ID do Produto:", id_produto)
    print("Nome do Produto:", nome_produto)
    print("Descrição:", descricao)
    print("Preço:", preco)
    print("Categoria Selecionada:", categoria)

    try:
        conexao = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="farmaexpress"
        )

        cursor = conexao.cursor()

        comando_sql = """
        INSERT INTO produtos (id, nome, descricao, preco, imagem, categoria)
        VALUES (%s, %s, %s, %s, %s, %s)
        """

        valores = (id_produto, nome_produto, descricao, preco, imagem, categoria)

        cursor.execute(comando_sql, valores)
        conexao.commit()

        print("Dados inseridos com sucesso!")
        limpar_campos()
        msg = QMessageBox()
        msg.setWindowTitle("Sucesso")
        msg.setText("Dados enviados com sucesso!")
        msg.exec_()
        
    except mysql.connector.Error as err:
        print(f"Erro ao conectar ao banco de dados: {err}")
        msg = QMessageBox()
        msg.setWindowTitle("Erro")
        msg.setText(f"Erro ao conectar ao banco de dados: {err}")
        msg.exec_()

    finally:
        if 'cursor' in locals() and cursor:  # Verifica se o cursor existe
            cursor.close()
        if 'conexao' in locals() and conexao.is_connected():  # Verifica se a conexão existe
            conexao.close()

if __name__ == '__main__':
    app = QtWidgets.QApplication([])  # Cria a aplicação
    formulario = uic.loadUi("formulario2.ui")  # Carrega a interface
    formulario.pushButton.clicked.connect(funcao_principal)  # Conecta o botão à função
    formulario.show()  # Exibe a janela
    app.exec_()  # Executa o loop da aplicação
