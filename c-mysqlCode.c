#define _CRT_SECURE_NO_WARNINGS    // fopen 보안 경고로 인한 컴파일 에러 방지
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
	MYSQL_RES   *sql_result;//쿼리의 결과
	MYSQL_ROW   sql_row;//결과 필드들의 내용 저장, 각 속성 열별로, 각 튜플 행별로 받아짐
	int       query;//쿼리에 오류가 없는 지 검사하기 위한 변수
	char q[255];//쿼리를 담는 변수
	int choose=4;//사용자가 선택한 기능에 대한 변수
	//사용자에게 입력받을 변수 
	int f_rno;
	char f_id[20];
	char f_cate[20];

	mysql_init(&conn);//초기화

	connection = mysql_real_connect(&conn, DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306, (char *)NULL, 0);//db와 연결

	if (connection == NULL)//연결 오류 검사
	{
		fprintf(stderr, "Mysql connection error : %s", mysql_error(&conn));
		return 1;
	}

	query = mysql_query(connection, "select * from favorite");//쿼리 
	if (query != 0)//쿼리 오류 검사
	{
		fprintf(stderr, "Mysql query error : %s", mysql_error(&conn));
		return 1;
	}

	sql_result = mysql_store_result(connection);//쿼리 수행 결과를 담음.

	//현재 구독 리스트 출력
	printf(">>회원 구독 채널 관리<<\n[현재 구독 LIST]\n");
	printf("%+10s %+15s %+15s \n", "ID","RadioNumber","Category");
	while ((sql_row = mysql_fetch_row(sql_result)) != NULL)//열 한 줄씩 받아 끝까지 출력
	{
		printf("%+10s", sql_row[0]);//사용자
		printf("%+15s", sql_row[1]);//라디오 번호
		printf("%+15s\n", sql_row[2]);//카테고리 출력
		//printf("\n");
	}
	//사용자가 0을 입력할 경우 프로그램은 종료됨.
	while (choose != 0) {
		printf("*1) 구독 추가하기 \n");
		printf("*2) 구독 삭제하기 \n");
		printf("*3) 구독 수정하기 \n");
		printf("*0) 프로그램 종료\n");
		scanf("%d", &choose);//기능을 입력받음.

		//구독을 추가하는 코드
		if (choose == 1) {
			printf(">>구독 추가하기<<\n");
			printf("-> 순서대로 필요한 정보를 입력해주세요.(아이디, 라디오번호, 카테고리)\n");
			scanf("%s", &f_id);
			scanf("%d", &f_rno);
			scanf("%s", &f_cate);
			//쿼리배열에 입력 받은 정보를 insert하는 쿼리 담음
			sprintf(q, "insert into favorite values('%s',%d,'%s')", f_id, f_rno, f_cate);
			query = mysql_query(connection, q);//연결, 쿼리 수행
			printf("\n구독이 추가되었습니다!!\n");
		}
		//구독을 삭제하느 코드
		else if (choose == 2) {
			printf(">>구독 삭제하기<<\n");
			printf("->리스트에서 삭제를 원하는 아이디와 라디오 번호를 입력해주세요.\n");
			scanf("%s", &f_id);
			scanf("%d", &f_rno);
			//쿼리배열에 입력 받은 정보를 delete하는 쿼리 담음
			sprintf(q, "delete from favorite where f_id='%s' and f_rno=%d", f_id, f_rno);
			query = mysql_query(connection, q);//연결, 쿼리 수행
			printf("\n구독이 삭제되었습니다!!\n");
		}
		else if (choose == 3) {
			printf(">>구독 수정하기<<\n");
			printf("->카테고리를 수정할 수 있는 기능입니다. 리스트에서 수정을 원하는 아이디와 라디오 번호를 입력해주세요.\n");
			scanf("%s", &f_id);
			scanf("%d", &f_rno);
			printf("->카테고리 수정 내용을 입력해주세요.\n");
			scanf("%s", &f_cate);
			//쿼리배열에 입력 받은 정보를 update하는 쿼리 담음
			sprintf(q, "update favorite set f_category='%s' where f_id='%s' and f_rno=%d", f_cate,f_id, f_rno);
			query = mysql_query(connection, q);
			printf("\n구독이 수정되었습니다!!\n");//연결, 쿼리 수행
		}
		else
			break;
	}

	mysql_free_result(sql_result);//메모리 해제
	mysql_close(connection);
}