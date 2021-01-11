#define _CRT_SECURE_NO_WARNINGS    // fopen ���� ���� ���� ������ ���� ����
#include <mysql.h>
#include <string.h>
#include <stdio.h>


#define DB_HOST "localhost"
#define DB_USER "seonda"
#define DB_PASS "itdb2019itdb2019"
#define DB_NAME "seonda"
#define CHOP(x) x[strlen(x) - 1] = ' '

int main(void)
{
	MYSQL       *connection = NULL, conn;
	MYSQL_RES   *sql_result;//������ ���
	MYSQL_ROW   sql_row;//��� �ʵ���� ���� ����, �� �Ӽ� ������, �� Ʃ�� �ະ�� �޾���
	int       query;//������ ������ ���� �� �˻��ϱ� ���� ����
	char q[255];//������ ��� ����
	int choose=4;//����ڰ� ������ ��ɿ� ���� ����
	//����ڿ��� �Է¹��� ���� 
	int f_rno;
	char f_id[20];
	char f_cate[20];

	mysql_init(&conn);//�ʱ�ȭ

	connection = mysql_real_connect(&conn, DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306, (char *)NULL, 0);//db�� ����

	if (connection == NULL)//���� ���� �˻�
	{
		fprintf(stderr, "Mysql connection error : %s", mysql_error(&conn));
		return 1;
	}

	query = mysql_query(connection, "select * from favorite");//���� 
	if (query != 0)//���� ���� �˻�
	{
		fprintf(stderr, "Mysql query error : %s", mysql_error(&conn));
		return 1;
	}

	sql_result = mysql_store_result(connection);//���� ���� ����� ����.

	//���� ���� ����Ʈ ���
	printf(">>ȸ�� ���� ä�� ����<<\n[���� ���� LIST]\n");
	printf("%+10s %+15s %+15s \n", "ID","RadioNumber","Category");
	while ((sql_row = mysql_fetch_row(sql_result)) != NULL)//�� �� �پ� �޾� ������ ���
	{
		printf("%+10s", sql_row[0]);//�����
		printf("%+15s", sql_row[1]);//���� ��ȣ
		printf("%+15s\n", sql_row[2]);//ī�װ� ���
		//printf("\n");
	}
	//����ڰ� 0�� �Է��� ��� ���α׷��� �����.
	while (choose != 0) {
		printf("*1) ���� �߰��ϱ� \n");
		printf("*2) ���� �����ϱ� \n");
		printf("*3) ���� �����ϱ� \n");
		printf("*0) ���α׷� ����\n");
		scanf("%d", &choose);//����� �Է¹���.

		//������ �߰��ϴ� �ڵ�
		if (choose == 1) {
			printf(">>���� �߰��ϱ�<<\n");
			printf("-> ������� �ʿ��� ������ �Է����ּ���.(���̵�, ������ȣ, ī�װ�)\n");
			scanf("%s", &f_id);
			scanf("%d", &f_rno);
			scanf("%s", &f_cate);
			//�����迭�� �Է� ���� ������ insert�ϴ� ���� ����
			sprintf(q, "insert into favorite values('%s',%d,'%s')", f_id, f_rno, f_cate);
			query = mysql_query(connection, q);//����, ���� ����
			printf("\n������ �߰��Ǿ����ϴ�!!\n");
		}
		//������ �����ϴ� �ڵ�
		else if (choose == 2) {
			printf(">>���� �����ϱ�<<\n");
			printf("->����Ʈ���� ������ ���ϴ� ���̵�� ���� ��ȣ�� �Է����ּ���.\n");
			scanf("%s", &f_id);
			scanf("%d", &f_rno);
			//�����迭�� �Է� ���� ������ delete�ϴ� ���� ����
			sprintf(q, "delete from favorite where f_id='%s' and f_rno=%d", f_id, f_rno);
			query = mysql_query(connection, q);//����, ���� ����
			printf("\n������ �����Ǿ����ϴ�!!\n");
		}
		else if (choose == 3) {
			printf(">>���� �����ϱ�<<\n");
			printf("->ī�װ��� ������ �� �ִ� ����Դϴ�. ����Ʈ���� ������ ���ϴ� ���̵�� ���� ��ȣ�� �Է����ּ���.\n");
			scanf("%s", &f_id);
			scanf("%d", &f_rno);
			printf("->ī�װ� ���� ������ �Է����ּ���.\n");
			scanf("%s", &f_cate);
			//�����迭�� �Է� ���� ������ update�ϴ� ���� ����
			sprintf(q, "update favorite set f_category='%s' where f_id='%s' and f_rno=%d", f_cate,f_id, f_rno);
			query = mysql_query(connection, q);
			printf("\n������ �����Ǿ����ϴ�!!\n");//����, ���� ����
		}
		else
			break;
	}

	mysql_free_result(sql_result);//�޸� ����
	mysql_close(connection);
}