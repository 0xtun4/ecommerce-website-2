package com.tuna.Repositories;

import com.tuna.Models.Member;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.config.EnableJpaRepositories;
import org.springframework.stereotype.Repository;

import java.util.Optional;
@EnableJpaRepositories
@Repository
public interface MemberRepo extends JpaRepository<Member, Long>{
        Optional<Member> findOneByEmailAndPassword(String email, String password);
        Member findByEmail(String email);
//        Member findMemberById(Long id);

//        Member findByMemberName(String memberName);
}
